<?php

namespace App\Services\Admin;

use App\Models\KyLuat;
use App\Models\HocVien;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;
use Auth;

class KyLuatService extends BaseService
{
    public function model()
    {
        return KyLuat::class;
    }

    public function getListKyLuat($conditions) 
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
            if($key->kyluat == null){
                $key['so_lan'] = "";
                $key['ly_do'] = "";
                $key['ghi_chu'] = "";
                $key['ngay'] = "";
            }else{
                if(count($key->kyluat()->get()) >1){
                    $key->kyluat = $key->kyluat()->orderBy('id','desc')->first();
                }
                $key['ngay'] = date("d-m-Y", strtotime($key->kyluat['ngay']));
                $key['so_lan'] = count($key->kyluat()->get());
                $key['ly_do'] = $key->kyluat->ly_do;
                $key['ghi_chu'] = $key->kyluat->ghi_chu;
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
