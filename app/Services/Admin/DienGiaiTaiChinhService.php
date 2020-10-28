<?php

namespace App\Services\Admin;

use App\Models\DienGiaiTaiChinh;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class DienGiaiTaiChinhService extends BaseService
{

    public function model()
    {
        return DienGiaiTaiChinh::class;
    }

    public function getListDienGiaiTaiChinh($conditions) 
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