<?php

namespace App\Services\Admin;

use App\Models\ChucVu;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class ChucVuService extends BaseService
{

    public function model()
    {
        return ChucVu::class;
    }

    public function getListChucVu($conditions) 
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