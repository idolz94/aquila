<?php

namespace App\Services\Admin;

use App\Models\Nhom;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;


class NhomService extends BaseService
{
    public function model()
    {
        return Nhom::class;
    }

    public function getListNhom($conditions) 
    {
      $listNhom = $this->all();
        foreach ($listNhom as $key) {
            $key['ten_truong_nhom'] = $key->truongnhom->ten;
            $key['nhom_cha'] = $key->nhomcha->ten;
            $key['ngay_bat_dau'] = date("d-m-Y",strtotime($key['ngay_bat_dau'])); 
            $key['ngay_ket_thuc'] = date("d-m-Y",strtotime($key['ngay_ket_thuc']));
        }
        return response()->json([
            'data' => $listNhom
        ]);
    }

    public function store($request)
    {
        return $this->create($request->all());
    }
}
