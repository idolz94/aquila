<?php

namespace App\Services\Admin;

use App\Models\TinhTrangNghien;
use App\Models\HocVien;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;
use Auth;

class TinhTrangNghienService extends BaseService
{
    public function model()
    {
        return TinhTrangNghien::class;
    }

    public function getListTinhTrangNghien($conditions) 
    {
        if(Auth::guard('admin')->user()->role == 1){
            $hocvienAll = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocvienAll = HocVien::where('gioi_tinh','Nam')->with('nguoibaoho')->get();
            }else{
                $hocvienAll = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        foreach ($hocvienAll as $key) {
            if($key->tinhtrangnghien == null){
                $key['so_lan'] = "";
            }else{
                $key['so_lan'] = count($key->tinhtrangnghien()->get());
            }
        }
    
        return response()->json([
            'data' => $hocvienAll
        ]);
    }

    public function store($request)
    {
        return $this->create($request);
    }

    public function storeQTSD($request){
        return DB::table('qua_trinh_su_dung')->insert([
            'tinh_trang_nghien_id'=>$request->id,
            'lan_dau'=>$request->lan_dau,
            'ly_do'=>$request->ly_do,
            'su_dung_hang_ngay'=>$request->su_dung_hang_ngay,
            'ngay_may_lan'=>$request->ngay_may_lan,
            'ham_luong_su_dung'=>$request->ham_luong_su_dung,
            'khong_su_dung'=>$request->khong_su_dung,
            'da_dung_loai_nao'=>$request->da_dung_loai_nao,
            'hinh_thuc_su_dung'=>$request->hinh_thuc_su_dung,
            'su_dung_gan_nhat'=>$request->su_dung_gan_nhat,
        ]);
    }

    public function updateQTSD($request){
        return DB::table('qua_trinh_su_dung')
        ->where('tinh_trang_nghien_id', $request->tinh_trang_nghien_id)
        ->update([
          'tinh_trang_nghien_id'=>$request->tinh_trang_nghien_id,
          'lan_dau'=>$request->lan_dau,
          'ly_do'=>$request->ly_do,
          'su_dung_hang_ngay'=>$request->su_dung_hang_ngay,
          'ngay_may_lan'=>$request->ngay_may_lan,
          'ham_luong_su_dung'=>$request->ham_luong_su_dung,
          'khong_su_dung'=>$request->khong_su_dung,
          'da_dung_loai_nao'=>$request->da_dung_loai_nao,
          'hinh_thuc_su_dung'=>$request->hinh_thuc_su_dung,
          'su_dung_gan_nhat'=>$request->su_dung_gan_nhat,
      ]);
    }

    public function storeSLCN($request){
        return DB::table('so_lan_cai_nghien')->insert([
            'tinh_trang_nghien_id'=>$request->id,
            'lan_cai_nghien'=>$request->lan_cai_nghien,
            'lan_thu_nhat'=>$request->lan_thu_nhat,
            'thoi_gian_lan_thu_nhat'=>$request->thoi_gian_lan_thu_nhat,
            'phuong_phap_lan_thu_nhat'=>$request->phuong_phap_lan_thu_nhat,
            'ly_do_tai_nghien_lan_thu_nhat'=>$request->ly_do_tai_nghien_lan_thu_nhat,
            'lan_thu_hai'=>$request->lan_thu_hai,
            'thoi_gian_lan_thu_hai'=>$request->thoi_gian_lan_thu_hai,
            'phuong_phap_lan_thu_hai'=>$request->phuong_phap_lan_thu_hai,
            'ly_do_tai_nghien_lan_thu_hai'=>$request->ly_do_tai_nghien_lan_thu_hai,
        ]);
    }

    public function updateSLCN($request){
        DB::table('so_lan_cai_nghien')
        ->where('tinh_trang_nghien_id', $request->tinh_trang_nghien_id)
        ->update([
            'tinh_trang_nghien_id'=>$request->tinh_trang_nghien_id,
            'lan_cai_nghien'=>$request->lan_cai_nghien,
            'lan_thu_nhat'=>$request->lan_thu_nhat,
            'thoi_gian_lan_thu_nhat'=>$request->thoi_gian_lan_thu_nhat,
            'phuong_phap_lan_thu_nhat'=>$request->phuong_phap_lan_thu_nhat,
            'ly_do_tai_nghien_lan_thu_nhat'=>$request->ly_do_tai_nghien_lan_thu_nhat,
            'lan_thu_hai'=>$request->lan_thu_hai,
            'thoi_gian_lan_thu_hai'=>$request->thoi_gian_lan_thu_hai,
            'phuong_phap_lan_thu_hai'=>$request->phuong_phap_lan_thu_hai,
            'ly_do_tai_nghien_lan_thu_hai'=>$request->ly_do_tai_nghien_lan_thu_hai,
        ]);
    }

}
