<?php

namespace App\Services\Admin;

use App\Models\BoMon;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class BoMonService extends BaseService
{

    public function model()
    {
        return BoMon::class;
    }

    public function getListBoMon($conditions) 
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