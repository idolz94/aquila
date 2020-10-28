<?php

namespace App\Services\Admin;

use App\Models\HanhKiem;
use App\Models\HocVien;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;
use Auth;
class HanhKiemService extends BaseService
{
    public function model()
    {
        return HanhKiem::class;
    }

    public function getListHanhKiem($conditions) 
    {
        if(Auth::guard('admin')->user()->role == 1){
            $hocvienAll = HocVien::all();
        }else{
            if(Auth::guard('admin')->user()->gender == 1 ){
                $hocvienAll = HocVien::where('gioi_tinh','Nam')->get();
            }else{
                $hocvienAll = HocVien::where('gioi_tinh','Nữ')->with('nguoibaoho')->get();
            }
        }
        foreach ($hocvienAll as $key) {
            if($key->hanhkiem == null){
                $key['ky_luat'] = "";
                $key['ten_hanh_kiem'] = "";
            }else{
                $key['ky_luat'] = count($key->kyluat()->get());
                if(count($key->hanhkiem()->get()) >1){
                    foreach($key->hanhkiem()->get() as $hanhkiem){
                        $key['ten_hanh_kiem'] = $hanhkiem->ten_hanh_kiem;
                    }
                }else{
                    $key['ten_hanh_kiem'] = $key->hanhkiem->ten_hanh_kiem;
                }
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

}
