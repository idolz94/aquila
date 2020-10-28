<?php

namespace App\Services\Admin;

use App\Models\ThoiKhoaBieu;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class ThoiKhoaBieuService extends BaseService
{
    public function model()
    {
        return ThoiKhoaBieu::class;
    }

    public function getListThoiKhoaBieu($conditions) 
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
