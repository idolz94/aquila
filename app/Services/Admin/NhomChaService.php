<?php

namespace App\Services\Admin;

use App\Models\NhomCha;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;


class NhomChaService extends BaseService
{
    public function model()
    {
        return NhomCha::class;
    }

    public function getListNhomCha($conditions) 
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
