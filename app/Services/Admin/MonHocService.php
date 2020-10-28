<?php

namespace App\Services\Admin;

use App\Models\MonHoc;
use App\Models\BoMon;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;


class MonHocService extends BaseService
{
    public function model()
    {
        return MonHoc::class;
    }

    public function getListMonHoc($conditions) 
    {
        return response()->json([
            'data' => $this->all()
        ]);
    }

    public function store($request)
    {
        
        return $this->create($request);
    }
}
