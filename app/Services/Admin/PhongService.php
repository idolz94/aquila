<?php

namespace App\Services\Admin;

use App\Models\Phong;
use App\Models\MonHoc;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;


class PhongService extends BaseService
{
    public function model()
    {
        return Phong::class;
    }

    public function getListPhong($conditions) 
    {
        $data =  DB::table('phongs')
        ->Leftjoin('hoc_viens', 'phongs.ten_truong_phong', '=', 'hoc_viens.id')
        ->select('phongs.*', 'hoc_viens.ten')
        ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function store($request)
    {
        return $this->create($request->all());
    }
}
