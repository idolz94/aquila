<?php

namespace App\Services\Admin;

use App\Models\KhamSucKhoe;
use App\Models\HocVien;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;
use Auth;

class KhamSucKhoeService extends BaseService
{
    public function model()
    {
        return KhamSucKhoe::class;
    }

    public function getListKhamSucKhoe($conditions) 
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
            if($key->khamsuckhoe == null){
                $key['so_lan'] = "";
                $key['ten_suckhoe'] = "";
                $key['ngay'] = "";
            }else{
                if(count($key->khamsuckhoe()->get()) >1){
                    $key->khamsuckhoe = $key->khamsuckhoe()->orderBy('id','desc')->first();
                }
                
                $key['ngay'] = date("d-m-Y", strtotime($key->khamsuckhoe['created_at']));
                $key['so_lan'] = count($key->khamsuckhoe()->get());
                $key['ten_suckhoe'] = $key->khamsuckhoe->ten;
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

    public function show($id){
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
