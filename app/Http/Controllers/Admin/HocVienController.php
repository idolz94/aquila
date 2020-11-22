<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Services\Admin\HocVienService;
use App\Models\HocVien;
use App\Models\DienGiaiTaiChinh;
use App\Models\TaiChinh;
use App\Models\NguoiBaoHo;
use App\Imports\HocVienImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HocVienExport;
use App\Exports\DiemHocVienExport;
use App\Exports\DiemDanhHocVienExport;
use App\Notifications\SendMailForNguoiBaoHo;
use Exception;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;

class HocVienController extends Controller
{
    public function __construct(HocVienService $hocvienService)
    {
        $this->hocvienService = $hocvienService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student.index');
    }
    public function listCalander()
    {
        return view('admin.student.index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.addnew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StudentRequest $request)
    public function store(StudentRequest $request)
    {
       
        $data = $request->only([
            'ho_va_ten_nguoi_bao_ho',
            'quan_he_hoc_vien',
            'email',
            'so_dien_thoai',
            'ma_hoc_vien', 
            'ten',
            'dia_chi', 
            'ngay_sinh', 
            'ngay_vao', 
            'gioi_tinh',
            'so_cmnd',
            'ngay_cap_cmnd', 
            'noi_cap_cmnd', 
            'trinh_do_van_hoa',
            'hon_nhan', 
            'nghe_nghiep', 
            'tinh_trang',
            'tien_an', 
            've_toi_tien_an', 
            'tien_su',
            've_toi_tien_su', 
            'ma_tuy_su_dung', 
            'hinh_thuc_su_dung',
            'tien_su_benh_ly', 
            'chieu_cao', 
            'can_nang',
            'avatar_hocvien',
            'images'
        ]);

        try {
            $isCreated = $this->hocvienService->store($data);
            if ($isCreated) {
                return redirect()->route('admin.hoc-vien.index')->with([
                    'message' => trans('admin/message.create_success'),
                ]);
            }
        } catch (Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.hoc-vien.index')->with([
                'error' => trans('admin/message.create_failed'),
            ]);
        }
        return redirect()->route('admin.hoc-vien.index')->with([
            'error' => trans('admin/message.create_failed'),
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
        $hocvien = $this->hocvienService->find($id);
        $diem_mon_hocs = $this->hocvienService->diemHV($id);
        $anhHocVien = $hocvien->anhhocvien()->get();
        $anhQuaTrinh = $hocvien->anhquatrinh()->get();
        $hv_taichinh = $hocvien->taichinh;
        if(count($hv_taichinh) !== 0){
            foreach ($hv_taichinh as $key) {
                $taichinh_id = $key->id;
                $hocvien['tong_ngay_nghi'] = $key->tong_ngay_ngi;
                $hocvien['tong_ngay_co_mat'] = $key->tong_ngay_co_mat;
            }
            $data['id'] = $taichinh_id;
            $taichinh = $this->hocvienService->filterTaiChinh($data);
            return view('admin.student.profile',compact('hocvien','taichinh','anhHocVien','anhQuaTrinh','diem_mon_hocs'));
        }
            return view('admin.student.profile',compact('hocvien', 'anhHocVien','anhQuaTrinh','diem_mon_hocs'));
      
    }
    
    public function filterTaiChinh($id,Request $request){
        $data['hoc_vien_id'] = $id;
        $data['month']= $request->month;
        $taichinh = $this->hocvienService->filterTaiChinh($data);
        if($taichinh !== false){
            return response()->json(['message'=>$taichinh],200);
        }
        return response()->json(['message'=>$taichinh],422);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hocVien = $this->hocvienService->findOrFail($id);
        return view('admin.student.edit', ['hocVien' => $hocVien]);
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
        $data = $request->only([
            'ho_va_ten_nguoi_bao_ho',
            'quan_he_hoc_vien',
            'email',
            'so_dien_thoai',
            'ma_hoc_vien', 
            'ten',
            'dia_chi', 
            'ngay_vao',
            'ngay_sinh', 
            'ngay_tot_nghiep',
            'so_cmnd',
            'ngay_cap_cmnd', 
            'noi_cap_cmnd', 
            'trinh_do_van_hoa',
            'hon_nhan', 
            'nghe_nghiep', 
            'tinh_trang',
            'tien_an', 
            've_toi_tien_an', 
            'tien_su',
            've_toi_tien_su', 
            'ma_tuy_su_dung', 
            'hinh_thuc_su_dung',
            'tien_su_benh_ly', 
            'chieu_cao', 
            'can_nang',
            'avatar_hocvien',
            'images',
            'images_type'
        ]);

        $hocVienUpdated = $this->hocvienService->edit($data, $id);
        
        if ($hocVienUpdated) {
            return redirect()->route('admin.hoc-vien.index')->with([
                'message' => trans('admin/message.update_success'),
            ]);
        }

        return redirect()->route('admin.hoc-vien.index')->with([
            'message' => trans('admin/message.update_failed'),
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
        if(Auth::guard('admin')->user()->role == 1){
            NguoiBaoHo::find($this->hocvienService->findOrFail($id)->nguoi_bao_ho_id)->delete();
            $hocvien = HocVien::find($id)->delete();
            if ($hocvien) {
                return redirect()->route('admin.hoc-vien.index')->with([
                    'message' => trans('admin/message.delete_success'),
                ]);
            }

            return redirect()->route('admin.hoc-vien.index')->with([
                'message' => trans('admin/message.delete_failed'),
            ]);
        }else{
            return back()->with('message','Bạn không có quyền xoá');
        }
    }

    public function list(Request $request)
    {
        return $this->hocvienService->getListHocVien($request);
    }

    public function vePhep($id){
        $hocvien = $this->hocvienService->findOrFail($id);
        return view('admin.vephep.index',compact('hocvien'));
    }

    public function import(Request $request) 
    {
        $data = [];
        foreach (json_decode($request->data,true) as $key => $value) {
            $so_dien_thoai = $value['Stt'];
            $nguoithan = $value['Stt'];
            if(isset($value['Đt Liên Hệ Gia Đình'])){
                    $so_dien_thoai = $value['Đt Liên Hệ Gia Đình'];
            }
            if(isset($value['Quan Hệ Gia Đình'])){
                $nguoithan = $value['Quan Hệ Gia Đình'];
            }
            if(isset($value['Chất Ma Túy Nghiện Trước Khi Vào Cơ Sở '])){
                $ma_tuy_su_dung = $value['Chất Ma Túy Nghiện Trước Khi Vào Cơ Sở '];
            }else{
                $ma_tuy_su_dung  = '';
            }
            $ngay_sinh = '';
            $stt = NguoiBaoHo::count();
            $filterHV = NULL;
            if(isset($value['Năm Sinh'])){
                $ngay_sinh = Carbon::parse($value['Năm Sinh']);
                $filterHV = HocVien::where('ten',$value['Họ Và Tên'])->where('ngay_sinh',$ngay_sinh)->where('dia_chi',$value['Địa Chỉ'])->first();
            }else{
                $filterHV = HocVien::where('ten',$value['Họ Và Tên'])->where('dia_chi',$value['Địa Chỉ'])->first();
            }
            $data[$key] = [
                'ten'=>$value['Họ Và Tên'],
                'sdt'=>$so_dien_thoai,
                'dia_chi'=>$value['Địa Chỉ'],
                'ngay_sinh' => $ngay_sinh,
                'ma_tuy_su_dung' =>$ma_tuy_su_dung,
                'ngay_vao'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['Ngày Vào Cơ Sở'])),
            ];
            if($filterHV == NULL){
                $hocvien = ([
                    'ho_va_ten_nguoi_bao_ho'=>$value['Họ Và Tên'],
                    'email'=>'',
                    'quan_he_hoc_vien'=>$nguoithan,
                    'so_dien_thoai'=>$so_dien_thoai,
                    'ten'=>$value['Họ Và Tên'],
                    'dia_chi'=>$value['Địa Chỉ'],
                    'ngay_sinh'=>$ngay_sinh,
                    'ngay_vao'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['Ngày Vào Cơ Sở'])),
                    'gioi_tinh'=>'Nam',
                    'so_cmnd'=>$value['Stt'],
                    'ma_tuy_su_dung'=>$ma_tuy_su_dung,
                ]);
                $isCreated = $this->hocvienService->store($hocvien);
                if($isCreated == true){
                    $data[$key]['success'] = 1;
                }else{
                    $data[$key]['success'] = 0;
                }
            }else{
                    $data[$key]['success'] = 0;
            }
        }

        return response()->json($data);
      
    } 
    // view import

    public function importView() 
    {
        $data = [];
        return view('admin.student.import_hv',compact('data'));
    } 

    public function export(){
        return Excel::download(new HocVienExport(),'Danh sách học viên .xlsx');
    }

   

    public function showExport($id){
        $hocvien = $this->hocvienService->findOrFail($id);
    }

    public function exportDiem($id){
        $hocvien = $this->hocvienService->findOrFail($id);
        return Excel::download(new DiemHocVienExport($hocvien),'Điểm '. $hocvien->ten.'.xlsx');
    }
    
    public function exportDiemDanh($id){
        $hocvien = $this->hocvienService->findOrFail($id);
        return Excel::download(new DiemDanhHocVienExport($hocvien),'Điểm Danh '. $hocvien->ten.'.xlsx');
    }


    public function theoDoiYTe($id)
    {
        $hocvien = $this->hocvienService->findOrFail($id);
        $tuoi = Carbon::parse($hocvien->ngay_sinh)->age;
        $tinhtrangnghiens = $this->hocvienService->tinhtrangnghien($id);
        $khamsuckhoes =  $this->hocvienService->tinhtrangnghien($id);
        
        // dd($khamsuckhoes);
        $template_document = new \PhpOffice\PhpWord\TemplateProcessor('yte.docx');
        $template_document->setValue('ten', $hocvien->ten);
        $template_document->setValue('dia_chi', $hocvien->dia_chi);
        $template_document->setValue('tuoi', $tuoi);
        $template_document->setValue('gioi_tinh', $hocvien->gioi_tinh);
        $template_document->setValue('ngay_sinh', Carbon::parse($hocvien->ngay_sinh)->format('d/m/Y') );
        $template_document->setValue('trinh_do_van_hoa', $hocvien->trinh_do_van_hoa);
        $template_document->setValue('nghe_nghiep', $hocvien->nghe_nghiep);
        $template_document->setValue('vo_chong', $hocvien->vo_chong);
        $template_document->setValue('ho_ten_nguoi_bao_ho', $hocvien->nguoibaoho->ten);
        // Tình trạng nghiện
        if($tinhtrangnghiens !== NULL){
            $template_document->setValue('lan_dau', $tinhtrangnghiens->lan_dau);
            $template_document->setValue('ly_do', $tinhtrangnghiens->ly_do);
            $template_document->setValue('ngay_may_lan', $tinhtrangnghiens->ngay_may_lan);
            $template_document->setValue('ham_luong_su_dung', $tinhtrangnghiens->ham_luong_su_dung);
            $template_document->setValue('da_dung_loai_nao', $tinhtrangnghiens->da_dung_loai_nao);
            $template_document->setValue('su_dung_gan_nhat',date("d-m-Y",strtotime($tinhtrangnghiens->su_dung_gan_nhat)));
            $template_document->setValue('lan_cai_nghien', $tinhtrangnghiens->lan_cai_nghien);
            $template_document->setValue('lan_thu_nhat', $tinhtrangnghiens->lan_thu_nhat);
            $template_document->setValue('thoi_gian_lan_thu_nhat', $tinhtrangnghiens->thoi_gian_lan_thu_nhat);
            $template_document->setValue('phuong_phap_lan_thu_nhat', $tinhtrangnghiens->phuong_phap_lan_thu_nhat);
            $template_document->setValue('ly_do_tai_nghien_lan_thu_nhat', $tinhtrangnghiens->ly_do_tai_nghien_lan_thu_nhat);
            $template_document->setValue('lan_thu_hai', $tinhtrangnghiens->lan_thu_hai);
            $template_document->setValue('thoi_gian_lan_thu_hai', $tinhtrangnghiens->thoi_gian_lan_thu_hai);
            $template_document->setValue('phuong_phap_lan_thu_hai', $tinhtrangnghiens->phuong_phap_lan_thu_hai);
            $template_document->setValue('ly_do_tai_nghien_lan_thu_hai', $tinhtrangnghiens->ly_do_tai_nghien_lan_thu_hai);
            $template_document->setValue('cac_benh_kem_theo', $tinhtrangnghiens->cac_benh_kem_theo);
            $template_document->setValue('co_dia_di_ung', $hocvien->nguoibaoho->co_dia_di_ung);
            $template_document->setValue('gia_dinh_ai_nghien', $hocvien->nguoibaoho->gia_dinh_ai_nghien);
        }
     
        //Khám sức khoẻ
        if($khamsuckhoes !== NULL){
            $template_document->setValue('toan_than', $khamsuckhoes->toan_than);
            $template_document->setValue('mach', $khamsuckhoes->mach);
            $template_document->setValue('huyet_ap', $khamsuckhoes->huyet_ap);
            $template_document->setValue('nhiet_do', $khamsuckhoes->nhiet_do);
            $template_document->setValue('can_nang', $khamsuckhoes->can_nang);
            $template_document->setValue('nhip_tho', $khamsuckhoes->nhip_tho);
            $template_document->setValue('ho_hap', $khamsuckhoes->ho_hap);
            $template_document->setValue('tuan_hoan', $khamsuckhoes->tuan_hoan);
            $template_document->setValue('tieu_hoa', $khamsuckhoes->tieu_hoa);
            $template_document->setValue('tiet_nieu_sinh_duc', $khamsuckhoes->tiet_nieu_sinh_duc);
            $template_document->setValue('mat', $khamsuckhoes->mat);
            $template_document->setValue('bieu_hien_chung', $khamsuckhoes->bieu_hien_chung);
            $template_document->setValue('bieu_hien_khac', $khamsuckhoes->bieu_hien_khac);
            $template_document->setValue('test_nhanh', $khamsuckhoes->test_nhanh);
            $template_document->setValue('tom_tat_benh_an', $khamsuckhoes->noi_dung);
            $template_document->setValue('ma_tuy_su_dung', $hocvien->ma_tuy_su_dung);
        }
        
        //save template with table
        $template_document->saveAs($hocvien->ten.'.docx');
        chmod($hocvien->ten.'.docx', 0777);
        return response()->download(public_path($hocvien->ten.'.docx'));

    }
    public function indexAnhQuaTrinh($id){
        $hocvien = $this->hocvienService->findOrFail($id);
        return view('admin.student.anhquatrinh',compact('hocvien'));
    }
    
    public function themAnhQuaTrinh(Request $request){
        $hocvien = $this->hocvienService->addImageQuaTrinh($request->all());
        return redirect()->route('admin.hoc-vien.show',$request->id)->with('succes','Thêm Ảnh Quá Trình Thành Công');
        
    }
}
