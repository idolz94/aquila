<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ThoiKhoaBieuService;
use App\Models\ThoiKhoaBieu;
use App\Http\Requests\Admin\ThoiKhoaBieuRequest;

use App\Models\MonHoc;
use App\Models\LopHoc;
use Carbon\Carbon;
use Exception;
use Session;
use Illuminate\Support\Facades\Validator;
class ThoiKhoaBieuController extends Controller
{

    protected $thoikhoabieuService;

    public function __construct(ThoiKhoaBieuService $thoikhoabieuService)
    {
        $this->thoikhoabieuService = $thoikhoabieuService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $id = 1;
        // $monhocs = MonHoc::all();
        $lophoc = LopHoc::find($id);
        $ma_lop_hoc = $lophoc->ma_lop_hoc;
        $ngaybatdau =  new \Carbon\Carbon($lophoc->ngay_bat_dau);
        $ngayketthuc =  new \Carbon\Carbon($lophoc->ngay_ket_thuc); 
        $days = $ngaybatdau->diff($ngayketthuc)->days;
        $data = [];
        $times = [
            "start"=> $lophoc->ngay_bat_dau,
            "end" => $lophoc->ngay_ket_thuc
        ];
        $date = $ngaybatdau->format('Y-m-d');
        for($i = 0; $i < $days; $i++)
        {   
            $thoikhoabieu =  ThoiKhoaBieu::where('lop_hoc_id',$lophoc->id)->where('ngay',$date)->first();
            $ca_hoc = [];
            $id_thoikhoabieu = '';
            $color = "#007bff";
            $title = $lophoc->ma_lop_hoc;
            if($thoikhoabieu !== NULL){
                $ca_hoc = ['ca_sang' => $thoikhoabieu->sang,'ca_chieu'=>$thoikhoabieu->chieu];
                $id_thoikhoabieu = $thoikhoabieu->id;
                $color = "#008000";
                $title = $thoikhoabieu['sang'].'  '.$thoikhoabieu['chieu'];
            }
                $data[] =  [
                    "title"=> $title,
                    "start"=> $date,
                    "cahoc"=> $ca_hoc,
                    "id_thoikhoabieu" =>$id_thoikhoabieu,
                    "color"=> $color
                ];
            $date = $ngaybatdau->addDays(1)->format('Y-m-d');
        }
        return view('admin.thoikhoabieu.index',compact('data','times','ma_lop_hoc','id'));
    }

    public function indexLopHoc(){
        $lophocs = LopHoc::all();
        $now = Carbon::now();
        foreach ($lophocs as $lophoc) {
            $ngayketthuc =  new \Carbon\Carbon($lophoc->ngay_ket_thuc); 
            if($ngayketthuc <= $now){
              $lophoc['active'] = 0;
            }
        }
        return view('admin.thoikhoabieu.all',compact('lophocs'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $ca_hoc_sang = '';
        $ca_hoc_chieu = '';
        $lophoc = LopHoc::find($request->lop_hoc_id);
        if($request->time_start_sang !== NULL && $request->time_end_sang !== Null){
            $time_start_sang = explode(' ',$request->time_start_sang);
            $time_end_sang = explode(' ',$request->time_end_sang);
            $ca_hoc_sang = $time_start_sang[0] . " - " .$time_end_sang[0];
        }if($request->time_start_chieu !== NULL && $request->time_end_chieu !== Null){
            $time_start_chieu = explode(' ',$request->time_start_chieu);
            $time_end_chieu = explode(' ',$request->time_end_chieu);
            $ca_hoc_chieu = $time_start_chieu[0] . " - " . $time_end_chieu[0];
        }if($request->start_date !== NULL && $request->end_date){
            $start_date =  new \Carbon\Carbon($request->start_date);
            $end_date =  new \Carbon\Carbon($request->end_date); 
            $days = $start_date->diff($end_date)->days;
            $date = $start_date->format('Y-m-d');
            for($i = 0; $i < $days; $i++)
            {
                $thoikhoabieu =  ThoiKhoaBieu::where('lop_hoc_id',$lophoc->id)->where('ngay',$date)->first();
                if($thoikhoabieu !== NULL){
                    $thoikhoabieu['sang'] = $ca_hoc_sang;
                    $thoikhoabieu['chieu'] = $ca_hoc_chieu;
                    $thoikhoabieu->save();
                }else{
                    ThoiKhoaBieu::create([
                        'sang' => $ca_hoc_sang,
                        'chieu' => $ca_hoc_chieu,
                        'ngay' => $date,
                        'lop_hoc_id'=>$request->lop_hoc_id,
                    ]);
                }

                $date = $start_date->addDays(1)->format('Y-m-d');
            }
        }else{
                ThoiKhoaBieu::create([
                'sang' => $ca_hoc_sang,
                'chieu' => $ca_hoc_chieu,
                'ngay' => $request->current_date,
                'lop_hoc_id'=>$request->lop_hoc_id,
            ]);
        }
        return back()->with('message', 'thêm thời khoá biểu thành công');
     
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        dd('show');
    }

    public function lopHoc(Request $request){
        if($request->id != NULL){
            $lophoc = LopHoc::find($request->id);
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
                $thoikhoabieu =  ThoiKhoaBieu::where('lop_hoc_id',$lophoc->id)->where('ngay',$date)->first();
                $ca_hoc = [];
                $id_thoikhoabieu = '';
                $color = "#007bff";
                $title = $lophoc->ma_lop_hoc;
                $ma_lop_hoc = '';
                if($thoikhoabieu !== NULL){
                    $ca_hoc = ['ca_sang' => $thoikhoabieu->sang,'ca_chieu'=>$thoikhoabieu->chieu];
                    $id_thoikhoabieu = $thoikhoabieu->id;
                    $color = "#008000";
                    $title = "Đã có ca học";
                    $ma_lop_hoc = $lophoc->ma_lop_hoc;
                }
                    $events[] =  [
                        "title"=> $title.' '.$thoikhoabieu['sang'].' '.$thoikhoabieu['chieu'].' '.$ma_lop_hoc,
                        "start"=> $date,
                        "cahoc"=> $ca_hoc,
                        "id_thoikhoabieu" =>$id_thoikhoabieu,
                        "color"=> $color
                    ];
                $date = $ngaybatdau->addDays(1)->format('Y-m-d');
            }
            // return response()->json($events,$start_end_times);
            return response()->json(array('data'=>$events,'times'=>$start_end_times));
        }else{
            $lophocs = LopHoc::all();
            $events = [];
            $start_end_times = [];
            foreach ($lophocs as $lophoc) {
                $ngaybatdau =  new \Carbon\Carbon($lophoc->ngay_bat_dau);
                $ngayketthuc =  new \Carbon\Carbon($lophoc->ngay_ket_thuc); 
                $days = $ngaybatdau->diff($ngayketthuc)->days;
               
                $start_end_times[] = [
                    "title"=> $lophoc->ma_lop_hoc,
                    "time_start"=> $lophoc->ngay_bat_dau,
                    "time_end" => $lophoc->ngay_ket_thuc
                ];
                $date = $ngaybatdau->format('Y-m-d');
                for($i = 0; $i < $days; $i++)
                {   
                    $thoikhoabieu =  ThoiKhoaBieu::where('lop_hoc_id',$lophoc->id)->where('ngay',$date)->first();
                    $ca_hoc = [];
                    $id_thoikhoabieu = '';
                    $color = "#007bff";
                    $title = $lophoc->ma_lop_hoc;
                    $ma_lop_hoc = '';
                    if($thoikhoabieu !== NULL){
                        $ca_hoc = ['ca_sang' => $thoikhoabieu->sang,'ca_chieu'=>$thoikhoabieu->chieu];
                        $id_thoikhoabieu = $thoikhoabieu->id;
                        $color = "#008000";
                        $title = "Đã có ca học";
                        $ma_lop_hoc = $lophoc->ma_lop_hoc;
                    }
                        $events[] =  [
                            "title"=> $title.' '.$thoikhoabieu['sang'].' '.$thoikhoabieu['chieu'].' '.$ma_lop_hoc,
                            "start"=> $date,
                            "cahoc"=> $ca_hoc,
                            "id_thoikhoabieu" =>$id_thoikhoabieu,
                            "color"=> $color
                        ];
                    $date = $ngaybatdau->addDays(1)->format('Y-m-d');
                }
            }
            return response()->json(array('data'=>$events,'times'=>$start_end_times));
            dd($thoikhoabieu);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thoikhoabieu =  ThoiKhoaBieu::find($id);
        if($request->time_start_sang !== NULL && $request->time_end_sang !== Null){
            $time_start_sang = explode(' ',$request->time_start_sang);
            $time_end_sang = explode(' ',$request->time_end_sang);
            // dd(strval($time_start_sang[0]) ."-");
            $ca_hoc_sang = $time_start_sang[0] . " - " .$time_end_sang[0];
            $thoikhoabieu->sang = $ca_hoc_sang;
            $thoikhoabieu->save();
        }if($request->time_start_chieu !== NULL && $request->time_end_chieu !== Null){
            $time_start_chieu = explode(' ',$request->time_start_chieu);
            $time_end_chieu = explode(' ',$request->time_end_chieu);
            $ca_hoc_chieu = $time_start_chieu[0] . " - " . $time_end_chieu[0];
            $thoikhoabieu->chieu = $ca_hoc_chieu;
            $thoikhoabieu->save();
        }
        return back()->with('message','Sửa thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
