<?php

namespace App\Services\Admin;

use App\Models\VePhep;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;


class VePhepService extends BaseService
{
    public function model()
    {
        return VePhep::class;
    }

    public function getListVePhep($id) 
    {
        return response()->json([
            'data' => VePhep::where('hoc_vien_id',$id)->get()
        ]);
    }

    public function store($request)
    {
        return $this->create($request->all());
    }
}
