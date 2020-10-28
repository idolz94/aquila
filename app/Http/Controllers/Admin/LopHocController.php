<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\LopHocService;
use App\Http\Requests\Admin\LopHocRequest;
use App\Models\MonHoc;
use App\Models\HocVien;
use App\Models\GiaoVien;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHoc;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChiTietLopHocExport;
use App\Exports\LopHocExport;
use Illuminate\Support\Facades\DB;
use Exception;
use Session;
use Auth;
class LopHocController extends Controller
{
    protected $lophocService;

    public function __construct(LopHocService $lophocService)
    {
        $this->lophocService = $lophocService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $monhocs = MonHoc::all();
        $giaoviens = GiaoVien::all();
        return view('admin.lophoc.index',compact('monhocs','giaoviens'));
    }

    public function list(Request $request)
    {
        $listClass = $this->lophocService->getListLopHoc($request->all());
        return $listClass;
    }

    public function listThoiKhoaBieu($id){
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $data['id'] = $id;
        $data['weekStartDate'] = $weekStartDate;
        $data['weekEndDate'] = $weekEndDate;
        $thoikhoabieu = $this->lophocService->thoikhoabieu($data);
        foreach($thoikhoabieu as $item)
        {
            $sang = explode('-', $item->sang);
            $sang_trim_space = str_replace(' ', '', $sang);
            $chieu = explode('-', $item->chieu);
            $chieu_trim_space = str_replace(' ', '', $chieu);
            if($item->sang){
                if(strlen($sang_trim_space[0]) < 5){
                    $sang_trim_space[0] = "0".$sang_trim_space[0];
                    if(strlen($sang_trim_space[1]) < 5){
                        $sang_trim_space[1] = "0".$sang_trim_space[1];
                    }
                }
                $thoikhoabieuAll[] = [
                    'id'=>$item->id,
                'title'=>$item->ma_lop_hoc,
                'start'=>$item->ngay."T".$sang_trim_space[0].":00",
                'end'=>$item->ngay."T".$sang_trim_space[1].":00",
                'url'=>route('admin.thoi-khoa-bieu.update',$item->id)];
            }if($item->chieu){
                $thoikhoabieuAll[] = [ 
                    'id'=>$item->id,
                'title'=>$item->ma_lop_hoc,
                'start'=>$item->ngay."T".$chieu_trim_space[0],
                'end'=>$item->ngay."T".$chieu_trim_space[1],
                'url'=>route('admin.thoi-khoa-bieu.update',$item->id)];
            }
           
        }
        // dd($thoikhoabieuAll);
        return response()->json($thoikhoabieuAll);
    }

  
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,Request $request)
    {
       
        $lophoc = $this->lophocService->find($id);
        if($request->path() == "lophoc-monhoc"){
            $monhocs = MonHoc::all();
            return view('admin.lophoc.form',compact('lophoc','monhocs'));
        }
        if(Auth::guard('admin')->user()->role == 1){
            $hocviens = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocviens = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocviens = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        foreach($hocviens as $key => $hocvien){
            if(!$hocvien->lophoc->isEmpty()){
                foreach($hocvien->lophoc as $lop_hocvien){
                    if($lop_hocvien->pivot->lop_hoc_id == $lophoc->id){
                        unset($hocviens[$key]);
                    }
                }
            }
        }
            return view('admin.lophoc.add_hv',compact('lophoc','hocviens'));
    }

    // *********** Điểm Danh Lớp Học *********** //

    public function listDiemDanh(Request $request)
    {
        $now = Carbon::now();
        $lophoc = $this->lophocService->find($request->id); 
        $data['id'] = $request->id;
        $thoikhoabieu = $this->lophocService->thoikhoabieu($data);
        if($now > $lophoc->ngay_ket_thuc){
            $now = new Carbon($lophoc->ngay_ket_thuc);
            $dayStart = $now->startOfDay()->format('Y-m-d H:i:s');
            $dayEnd  = $now->endOfDay()->format('Y-m-d H:i:s');
        }else{
            $dayStart = $now->startOfDay()->format('Y-m-d H:i:s');
            $dayEnd  = $now->endOfDay()->format('Y-m-d H:i:s');
        }
        $ngayBatDauLopHoc = $lophoc->ngay_bat_dau;
        $hocviens = $lophoc->hocvien;
        $count = 0;
        foreach($thoikhoabieu as $thoi_khoa_bieu) {
            if($thoi_khoa_bieu->sang != NULL){
                $count++;
           }if($thoi_khoa_bieu->chieu != NULL){
                $count++;
           }
        }
       
        foreach($hocviens as $key => $hocvien){
            if(!$hocvien->diemdanh->isEmpty()){
                
                    $hocvien['diem_danh'] = $hocvien->diemdanh()->wherePivot('lop_hoc_id',$request->id)->get()->count()."/".$count;
            }else{
                $hocvien['diem_danh'] = "0/".$count;
            }
            $hocvien['lop_hoc_id'] = $request->id;
        }
        return response()->json(['message'=>$hocviens]);
        // return view('admin.lophoc.list_diemdanh',compact('lophoc','hocviens','ngayBatDauLopHoc')); 
    }

    public function lophocDiemDanh($id){
        $data['id'] = $id;
        $thoikhoabieu = $this->lophocService->thoikhoabieu($data);
       if(count($thoikhoabieu) <1){
        return back()->with('error', 'Chưa có thời khoá biểu');
       }
        $now = Carbon::now();
        $dayStart = $now->startOfDay()->format('Y-m-d H:i:s');
        $dayEnd  = $now->endOfDay()->format('Y-m-d H:i:s');
        $lophoc = $this->lophocService->find($id);
        if($lophoc->ngay_bat_dau <= $now){
            $ngaybatdau =  new \Carbon\Carbon($lophoc->ngay_bat_dau);
            $ngayketthuc =  new \Carbon\Carbon($lophoc->ngay_ket_thuc); 
            $days = $ngaybatdau->diff($ngayketthuc)->days;
            $events = [];
            $start_end_times = [
                "title"=> $lophoc->ma_lop_hoc,
                "time_start"=> $lophoc->ngay_bat_dau,
                "time_end" => $lophoc->ngay_ket_thuc
            ];
            $date = $ngaybatdau->format('Y-m-d');
            for($i = 0; $i < $days; $i++)
            {
                
                $events[] =  [
                    "title"=> $lophoc->ma_lop_hoc,
                    "start"=> $date,
                    "end"=>$date,
                    "url"=> '/'.'lophoc/'.$lophoc->id.'/diemdanh/create/ngay?id='.$lophoc->id.'&ngay='.$date,
                ];
                $date = $ngaybatdau->addDays(1)->format('Y-m-d');
            }
            $arr = [];
            // dd($thoikhoabieu,$events);
            for ($tkb=0; $tkb <count($thoikhoabieu) ; $tkb++) { 
                for ($i=0; $i < count($events); $i++) {
                    if($events[$i]['start'] == $thoikhoabieu[$tkb]->ngay){
                        if(!empty($thoikhoabieu[$tkb]->sang) && !empty($thoikhoabieu[$tkb]->chieu)){
                            $chieu = explode(' - ',$thoikhoabieu[$tkb]->chieu);
                            $sang =  explode(' - ',$thoikhoabieu[$tkb]->sang);
                            $events[] = [
                                "title"=>  $events[$i]['title'],
                                "start"=> $events[$i]['start'].'T'.$chieu[0].':00',
                                "end"=> $events[$i]['start'].'T'.$chieu[1].':00',
                                "url"=> $events[$i]['url'].'&type=1',
                                "type"=> '1',
                            ];
                            $events[$i]['start'] =  $events[$i]['start'].'T'.$sang[0].':00';
                            $events[$i]['end'] =  $events[$i]['end'].'T'.$sang[1].':00';
                            $events[$i]['url']=  $events[$i]['url'].'&type=0';
                            $events[$i]['type'] =  '0';
                        }
                        if($thoikhoabieu[$tkb]->chieu && empty($thoikhoabieu[$tkb]->sang)){
                            $chieu = explode(' - ',$thoikhoabieu[$tkb]->chieu);
                            $events[$i]['start'] = $events[$i]['start'].'T'.$chieu[0].':00';
                            $events[$i]['end'] = $events[$i]['end'].'T'.$chieu[1].':00';
                            $events[$i]['url']=  $events[$i]['url'].'&type=1';
                            $events[$i]['type'] =  '1';
                        }if($thoikhoabieu[$tkb]->sang && empty($thoikhoabieu[$tkb]->chieu)){
                            $sang =  explode(' - ',$thoikhoabieu[$tkb]->sang);
                            $events[$i]['start'] = $events[$i]['start'].'T'.$sang[0].':00';
                            $events[$i]['end'] = $events[$i]['end'].'T'.$sang[1].':00';
                            $events[$i]['url']=  $events[$i]['url'].'&type=0';
                            $events[$i]['type'] =  '0';
                        }
                    }
                }
            }
            return view('admin.lophoc.create_diemdanh',compact('lophoc','events'));
        }
        return back()->with('error', 'Chưa tới ngày học');
    }

    public function lophocDiemDanhDetail(Request $request){
        $lophoc = $this->lophocService->find($request->id);
        $hocviens = $lophoc->hocvien;
        $ngay = $request->ngay;
       
        $thoikhoabieu = ThoiKhoaBieu::where('ngay',$request->ngay)->first();

        if($thoikhoabieu == null){
            return back()->with('message','Chưa có thời khoá biểu cho ngày ',$ngay);
        }
        if($request->type == 0){
            foreach ($hocviens as $hocvien) {
            
                if($hocvien->diemdanh()->wherePivot('lop_hoc_id',$lophoc->id)->wherePivot('ngay',$ngay)->wherePivot('ca_hoc',0)->get()->count() > 0){
                    $hocvien['active'] = 1;
                }else{
                    $hocvien['active'] = 0;
                };
             }
            return view('admin.lophoc.create_diemdanh_detail_sang',compact('lophoc','hocviens','ngay','thoikhoabieu'));
        }
        foreach ($hocviens as $hocvien) {
            
            if($hocvien->diemdanh()->wherePivot('lop_hoc_id',$lophoc->id)->wherePivot('ngay',$ngay)->wherePivot('ca_hoc',1)->get()->count() > 0){
                $hocvien['active'] = 1;
            }else{
                $hocvien['active'] = 0;
            };
         }
        return view('admin.lophoc.create_diemdanh_detail_chieu',compact('lophoc','hocviens','ngay','thoikhoabieu'));

    }

    public function monHocDiemDanhPost(Request $request){
        
        $lophoc = $this->lophocService->find($request->id);
        if($request->ca_hoc == 0){
        
            $lophoc->diemdanh()->attach($request->hoc_vien_id,['ca_hoc' =>$request->ca_hoc,'ngay'=>$request->ngay]);
        }if($request->ca_hoc == 1){
            $lophoc->diemdanh()->attach($request->hoc_vien_id,['ca_hoc' => $request->ca_hoc,'ngay'=>$request->ngay]);
        }
        return redirect()->route('admin.lophoc.diemdanh', $request->id)->with('message', 'thêm điểm danh thành công');
    }

    // ************ END ĐIỂM DANH ************/

    public function lopHocDiem($id){
        $now = Carbon::now();
        $lophoc = $this->lophocService->find($id);
        if($lophoc->ngay_bat_dau <= $now){
            $hocviens = $lophoc->hocvien;
            $ly_dos = DB::table('ly_do_diem')->get();
            return view('admin.lophoc.diem_create',compact('lophoc','hocviens','ly_dos'));
        }
        return back()->with('error', 'Chưa tới ngày học');
    }

    public function storeDiem(Request $request){
        $lophoc = $this->lophocService->find($request->id);
        foreach ($request->diem as $hoc_vien_id =>$diem) {
            if(!$diem == null){
                $lophoc->diem_monhoc()->attach($hoc_vien_id,['diem' => $diem,'ly_do_id' => $request->ly_do_id]);
            }
        }
        // dd(1);
        return redirect()->route('admin.lophoc.diem')->with('message', 'thêm điểm thành công');
    }

    /**
     *  a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LopHocRequest $request)
    {
        $result = $this->lophocService->store($request);
      
        if ($result) {
            Session::flash('message', trans('Thêm thành công !'));
            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', trans('Thêm thất bại ! '));
        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lophoc = $this->lophocService->find($id);
        return view('admin.lophoc.detail',compact('lophoc'));
    }



    public function monHocDiemlist($id)
    {
        $lophoc = $this->lophocService->find($id);
        $ly_dos = DB::table('ly_do_diem')->get();
        return view('admin.lophoc.list_diem',compact('lophoc','ly_dos'));
    }

    public function monHocDiemLyDo(Request $request){
        $hocviens = $this->lophocService->find($request->lop_hoc_id)->hocvien;
        $diem_monhoc = $this->lophocService->diem_lydo($request);
            foreach($hocviens as $hocvien )
            {
                $diem_hv = [];
                $hocvien['diem'] = [];
                foreach($diem_monhoc as $diem) {
                
                    if($diem->id == $hocvien->id){
                        $diem_hv[] =  date('d/m/Y', strtotime($diem->created_at)) . " - " . $diem->diem;
                    }
                        $hocvien['diem'] = $diem_hv;
                }
            }
        return response()->json([$hocviens]);
    }

    public function lopHocVien(Request $request,$id)
    {
        $lophoc = $this->lophocService->find($id);
        $lophoc->hocvien()->attach($request->hoc_vien_id);
        Session::flash('message', trans('Thêm thành công !'));
        return redirect()->route('admin.lophoc.show',$id)->with('message', 'thêm học viên vào lớp thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lophoc = $this->lophocService->find($id);
        return view('admin.lophoc.edit',compact('lophoc'));
    }
    public function editJson($id){
        $lophoc = $this->lophocService->find($id);
        return response()->json(['message'=>$lophoc]);
    }

    /**
     *  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lophoc = $this->lophocService->find($id);
        if($lophoc->ma_lop_hoc == $request->ma_lop_hoc){
            $request->request->remove('ma_lop_hoc');
        }
        $result = $this->lophocService->update($request->all(),$id);
        if ($result) {
            Session::flash('message', trans('Thêm thành công !'));
            return response()->json([
                'status' => true,
            ]);
        }
        Session::flash('error', trans('Thêm thất bại ! '));
        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $this->lophocService->delete($id);

            return redirect()->route('admin.lophoc.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.lophoc.index')->with('error', 'Xóa không thành công');
        }
    }

    public function filter(Request $request){
        $monhocs = MonHoc::all();
        $dateNow = \Carbon\Carbon::today('Asia/Ho_Chi_Minh');
        $status = $request->ngay_bat_dau;
        if($request->ngay_bat_dau == 0){
          
            $lophocs = LopHoc::where('ngay_bat_dau','<=' ,$dateNow)->where('ngay_ket_thuc','>' ,$dateNow)->get();
        }elseif($request->ngay_bat_dau == 1){
            $lophocs = LopHoc::where('ngay_bat_dau','>' ,$dateNow)->get();
        }else{
            $lophocs = LopHoc::where('ngay_ket_thuc','<' ,$dateNow)->get();
        }
        foreach($lophocs as $lophoc){
            $lophoc['ngay_bat_dau'] = date("d-m-Y",strtotime($lophoc['ngay_bat_dau'])); 
            $lophoc['ngay_ket_thuc'] = date("d-m-Y",strtotime($lophoc['ngay_ket_thuc'])); 
            $lophoc['mon_hoc_id'] = $lophoc->monhoc->mon_hoc;
        }
        return response()->json($lophocs);
    }

    public function showDiemDanh($id,$lophoc){
        $lophoc = $this->lophocService->find($lophoc);
        $hocvien = HocVien::find($id);
        $diemdanh = $hocvien->diemdanh()->wherePivot('lop_hoc_id',$lophoc->id)->get();
        $data['id'] = $lophoc->id;
        $thoikhoabieu = $this->lophocService->thoikhoabieu($data);
        foreach($thoikhoabieu as $thoi_khoa_bieu){
           foreach($diemdanh as $diem_danh){
               if(date("Y-m-d",strtotime($thoi_khoa_bieu->ngay)) == date("Y-m-d",strtotime($diem_danh->pivot->ngay))){
                   $thoi_khoa_bieu->diem_danh = 1;
                   $thoi_khoa_bieu->ca_hoc[] = $diem_danh->pivot->ca_hoc;
               }
           }
        }
        return view('admin.lophoc.detail_diemdanh',compact('hocvien','thoikhoabieu','lophoc')); 
    }

    public function listLopDiemDanh(){
        $lops = LopHoc::all();
        return view('admin.lophoc.diemdanh',compact('lops'));
    }

    public function listDiemHocVien(Request $request){
        $hocviens = $this->lophocService->find($request->id)->hocvien;
        return response()->json(['message'=>$hocviens],200);
    }

    public function listLopDiem(){
        $lops = LopHoc::all();
        $ly_dos = DB::table('ly_do_diem')->get();
        return view('admin.lophoc.diem',compact('lops','ly_dos'));
    }


    public function exportDetail($id){
        $lophoc = $this->lophocService->find($id);
        return Excel::download(new ChiTietLopHocExport($lophoc), $lophoc->ma_lop_hoc.'.xlsx');
    }
    public function export(){
        return Excel::download(new LopHocExport(), 'Danh sách lớp học.xlsx');
    }

    public function createImages($id){
        $lophoc = $this->lophocService->find($id);
        return view('admin.lophoc.create_images',compact('lophoc'));
    }
    public function storeImages($id,Request $request){
        $lophoc = $this->lophocService->find($id);
        $lophoc = $this->lophocService->addImage($lophoc,$request->all());
        return redirect()->route('admin.lophoc.index')->with('succes','Thêm Ảnh Quá Trình Thành Công');

    }
}
