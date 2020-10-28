<?php

namespace App\Services\Admin;

use App\Models\HePhai;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class HePhaiService extends BaseService
{

    public function model()
    {
        return HePhai::class;
    }

    public function getListHePhai($conditions) 
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