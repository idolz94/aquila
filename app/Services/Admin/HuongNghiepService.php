<?php

namespace App\Services\Admin;

use App\Models\HuongNghiep;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;


class HuongNghiepService extends BaseService
{
    public function model()
    {
        return HuongNghiep::class;
    }


    public function getListHuongNghiep($conditions) 
    {
        return response()->json([
            'data' => $this->all()
        ]);
    }

    public function store($request)
    {
        return $this->create($request->all());
    }

}
