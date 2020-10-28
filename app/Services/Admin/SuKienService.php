<?php

namespace App\Services\Admin;

use App\Models\SuKien;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class SuKienService extends BaseService
{
    public function model()
    {
        return SuKien::class;
    }


    public function getListSuKien($conditions) 
    {
        foreach ($hocviens = $this->all() as $key) {
            $sukien[] = ['title' =>$key->ten,
                        'description'=>$key->noi_dung,
                        'url'=>'sukien/'.$key->id,
                        'color'=>$key->ma_mau,
                        'start'=>$key->ngay_bat_dau,
                        'end' =>$key->ngay_ket_thuc
            ];
        }
        return response()->json([
            'data' => $sukien
        ]);
    }

    public function store($request)
    {
        return $this->create($request);
    }

}
