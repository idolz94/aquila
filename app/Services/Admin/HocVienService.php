<?php

namespace App\Services\Admin;

use App\Models\HocVien;
use App\Models\NguoiBaoHo;
use App\Models\AnhHocVien;
use App\Services\Helpers\ImageService;
use Exception;
use DB;
use Auth;
use App\Models\TaiChinh;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class HocVienService extends BaseService
{
    public function model()
    {
        return HocVien::class;
    }

    public function getListHocVien($conditions) 
    {
        if(Auth::guard('admin')->user()->role == 1){
            $hocVienList = $this->model->with('nguoibaoho')->get();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocVienList = $this->model->where('gioi_tinh','Nam')->with('nguoibaoho')->get();
            }else{
                $hocVienList = $this->model->where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        return response()->json([
            'data' => $hocVienList
        ]);
    }

    public function store($request)
    {
   
        try {
       
            DB::beginTransaction();
            $dataNguoiBaoHo = [
                'ten' => $request['ho_va_ten_nguoi_bao_ho'],
                'email' => $request['email'],
                'password' => Hash::make(config('hocvien.nguoi_bao_ho.password_default')),
                'quan_he_hoc_vien' => $request['quan_he_hoc_vien'],
                'so_dien_thoai' => $request['so_dien_thoai']
            ];
            
            $dataHocVien = array_except($request, [
                'ho_va_ten_nguoi_bao_ho',
                'email_nguoi_bao_ho',
                'quan_he_hoc_vien',
                'so_dien_thoai',
            ]);

            $nguoiBaoHo = NguoiBaoHo::create($dataNguoiBaoHo);

            if ($nguoiBaoHo) {
                $stt = $nguoiBaoHo->id;
                $ngay_vao = date("m.Y",strtotime($dataHocVien['ngay_vao']));
                $dataHocVien['nguoi_bao_ho_id'] = $nguoiBaoHo->id;
                $dataHocVien['ma_hoc_vien'] = $stt.'-'.$ngay_vao;
            }
            $hocVien = $this->model->create($dataHocVien);
       
            if (isset($dataHocVien['avatar_hocvien'])) {    
                $type = 'user_avatar';
                $dataHocVien['avatar_hocvien'] = ImageService::uploadFile($dataHocVien['avatar_hocvien'], $type, config('images.paths.' . $type));
                $hocVien->avatar_url = $dataHocVien['avatar_hocvien'];
                $hocVien->save();
            }
            
            if (isset($dataHocVien['images'])) {
                $typeImages = 'image_hocvien';
                foreach ($dataHocVien['images'] as $image) {
                    $fileName = ImageService::uploadFile($image, $typeImages, config('images.paths.' . $typeImages));
                    $hocVien->anhhocvien()->create(['anh_hoc_vien' => $fileName]);
                }
            }

            DB::commit();

            return $hocVien;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);

            return false;
        }
    }

    public function edit($request, $id)
    {

        try {
            DB::beginTransaction();
            // dd($request);
            $hocVien = $this->findOrFail($id);
            $imageHocVien = $hocVien->anhhocvien()->get();
            $avatarUrl = $hocVien->getOriginal('avatar_url');

            $dataNguoiBaoHo = [
                'ten' => $request['ho_va_ten_nguoi_bao_ho'],
                'email' => $request['email'],
                'password' => Hash::make(config('hocvien.nguoi_bao_ho.password_default')),
                'quan_he_hoc_vien' => $request['quan_he_hoc_vien'],
                'so_dien_thoai' => $request['so_dien_thoai']
            ];

            $dataHocVien = array_except($request, [
                'ho_va_ten_nguoi_bao_ho',
                'email',
                'quan_he_hoc_vien',
                'so_dien_thoai',
                'avatar_hocvien'
            ]);

            $nguoiBaoHo = $hocVien->nguoibaoho();

            $nguoiBaoHo->update($dataNguoiBaoHo);
            
            $hocVien->update($dataHocVien);

            if (isset($request['avatar_hocvien'])) {
                $type = 'user_avatar';
                $dataHocVien['avatar_hocvien'] = ImageService::uploadFile($request['avatar_hocvien'], $type, config('images.paths.' . $type));
                $hocVien->avatar_url = $dataHocVien['avatar_hocvien'];
                $hocVien->save();

                if ($avatarUrl) {
                    foreach (config('images.dimensions.user_avatar') as $size => $value) {
                        $fileName = ($size == 'original' ? 'original' : $size ) . '/' . $avatarUrl;

                        if ($fileName) {
                            ImageService::delete(config('images.paths.' . $type), $fileName);
                        }
                    }
                }
            }

            if (isset($dataHocVien['images'])) {
                $typeImages = 'image_hocvien';
                foreach ($dataHocVien['images'] as $image) {
                    $fileName = ImageService::uploadFile($image, $typeImages, config('images.paths.' . $typeImages));
                    $hocVien->anhhocvien()->create(['anh_hoc_vien' => $fileName]);
                }
                // }else{
                //     foreach ($dataHocVien['images'] as $image) {
                //         $fileName = ImageService::uploadFile($image, $typeImages, config('images.paths.' . $typeImages));
                //         $hocVien->anhhocvien()->create(['anh_hoc_vien' => $fileName]);
                //     }
                if($dataHocVien['images_type'] == 0){        
                    if (count($imageHocVien)) {
                        foreach ($imageHocVien as $img) {
                            foreach (config('images.dimensions.image_hocvien') as $size => $value) {
                                $fileNameImage = ($size == 'original' ? 'original' : $size ) . '/' . $img->anh_hoc_vien;
        
                                if ($fileName) {
                                    ImageService::delete(config('images.paths.' . $typeImages), $fileNameImage);
                                }
                            }
                            $img->delete();
                        }
                    }
                }
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);

            return false;
        }
    }

    public function filterTaiChinh(array $request = []){
        $taichinh = DB::table('thu_chi_tai_chinhs')
        ->Leftjoin('tai_chinhs', 'thu_chi_tai_chinhs.tai_chinh_id', '=', 'tai_chinhs.id')
        ->Leftjoin('dien_giai_tai_chinhs', 'thu_chi_tai_chinhs.dien_giai_tai_chinh_id', '=', 'dien_giai_tai_chinhs.id')
        ->select('thu_chi_tai_chinhs.*', 'tai_chinhs.tong_ngay_ngi', 'tai_chinhs.tong_ngay_co_mat','tai_chinhs.thang','dien_giai_tai_chinhs.ten_dien_giai','dien_giai_tai_chinhs.thu_chi');
      
        if(isset($request['month'])){
            $month = date("m",strtotime($request['month'])); 
            $data =  TaiChinh::where('tai_chinhs.thang',$month)->first();
            if($data == null){
                return false;
            }
            $request['id'] = $data->id;
        }
        if(isset($request['id'])){
            $taichinh->where('thu_chi_tai_chinhs.tai_chinh_id',$request['id']);
        }if(isset($request['hoc_vien_id'])){
            $taichinh->where('tai_chinhs.hoc_vien_id',$request['hoc_vien_id']);
        }
        return $taichinh->get();
       
    }

    public function addImageQuaTrinh($request){
        $hocvien = $this->findOrFail($request['id']);
        $imageHocVien = $hocvien->anhquatrinh()->get();  
        // dd($imageHocVien,$request);
        if (isset($request['images'])) {
            $typeImages = 'image_hocvien';
            foreach ($request['images'] as $image) {
                $fileName = ImageService::uploadFile($image, $typeImages, config('images.paths.' . $typeImages));
                $hocvien->anhquatrinh()->create(['anh_hoc_vien' => $fileName]);
            }
            if($request['images_type'] == 0){  
                if (count($imageHocVien)) {
                    foreach ($imageHocVien as $img) {
                        foreach (config('images.dimensions.image_hocvien') as $size => $value) {
                            $fileNameImage = ($size == 'original' ? 'original' : $size ) . '/' . $img->anh_hoc_vien;
    
                            if ($fileName) {
                                ImageService::delete(config('images.paths.' . $typeImages), $fileNameImage);
                            }
                        }
                        $img->delete();
                    }
                }
            }
            return true;
        }

        return false;
    }

    public function deleteHocVien($id)
    {
        try {
            $hocVien = $this->findOrFail($id);
            $hocVien->delete();
            return true;
        } catch (Exception $e) {
            Log::debug($e);

            return false;
        }
    }

    public function diemHV($id){
        return DB::table('diem_mon_hocs')
            ->Leftjoin('lop_hocs', 'diem_mon_hocs.lop_hoc_id', '=', 'lop_hocs.id')
            ->Leftjoin('ly_do_diem', 'diem_mon_hocs.ly_do_id', '=', 'ly_do_diem.id')
            ->Leftjoin('hoc_viens', 'diem_mon_hocs.hoc_vien_id', '=', 'hoc_viens.id')
            ->select('diem_mon_hocs.*', 'lop_hocs.ma_lop_hoc', 'lop_hocs.ngay_bat_dau','lop_hocs.ngay_ket_thuc','ly_do_diem.ten')
            ->where('hoc_viens.id',$id)
            ->get();
    }

    public function tinhtrangnghien($id){
        return DB::table('tinh_trang_nghien')
        ->Leftjoin('hoc_viens', 'tinh_trang_nghien.hoc_vien_id', '=', 'hoc_viens.id')
        ->Leftjoin('so_lan_cai_nghien', 'tinh_trang_nghien.id', '=', 'so_lan_cai_nghien.tinh_trang_nghien_id')
        ->Leftjoin('qua_trinh_su_dung', 'tinh_trang_nghien.id', '=', 'qua_trinh_su_dung.tinh_trang_nghien_id')
        ->select('hoc_viens.ten', 'tinh_trang_nghien.*','so_lan_cai_nghien.*','qua_trinh_su_dung.*')
        ->where('tinh_trang_nghien.hoc_vien_id',$id)
        ->first();
    }
    
    public function khamsuckhoe($id){
        return DB::table('kham_suc_khoes')
        ->Leftjoin('hoc_viens', 'kham_suc_khoes.hoc_vien_id', '=', 'hoc_viens.id')
        ->Leftjoin('suc_khoe_toan_than', 'kham_suc_khoes.id', '=', 'suc_khoe_toan_than.kham_suc_khoe_id')
        ->Leftjoin('suc_khoe_tam_than', 'kham_suc_khoes.id', '=', 'suc_khoe_tam_than.kham_suc_khoe_id')
        ->Leftjoin('suc_khoe_co_quan', 'kham_suc_khoes.id', '=', 'suc_khoe_co_quan.kham_suc_khoe_id')
        ->select('hoc_viens.ten', 'kham_suc_khoes.*','suc_khoe_toan_than.*','suc_khoe_tam_than.*','suc_khoe_co_quan.*')
        ->where('kham_suc_khoes.id',$id)
        ->first();
    }

    
}
