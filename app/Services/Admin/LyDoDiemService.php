<?php

namespace App\Services\Admin;

use App\Models\LopHoc;
use App\Models\LyDoDiem;
use Exception;
use DB;


class LyDoDiemService extends BaseService
{
    public function model()
    {
        return LyDoDiem::class;
    }

    public function getListLyDoDiem($conditions) 
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
