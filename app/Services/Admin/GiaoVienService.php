<?php

namespace App\Services\Admin;

use App\Models\GiaoVien;
use App\Services\Helpers\ImageService;
use Exception;
use DB;

class GiaoVienService extends BaseService
{
    public function model()
    {
        return GiaoVien::class;
    }


    public function getListGiaoVien($conditions) 
    {
        $giaoviens = $this->all();
        foreach ($giaoviens as $key) {
            $key['ngay_sinh'] = date("d-m-Y",strtotime($key['ngay_sinh'])); 
            $key['he_phai'] = $key->hephai->ten; 
            $key['chuc_vu'] = $key->chucvu->ten; 
         }
        return response()->json([
            'data' => $giaoviens
        ]);
    }

    public function store($request)
    {
        $data = $request->all();
        if (isset($data['anh_dai_dien'])) {
            $type = 'teacher_avatar';
            $data['anh_dai_dien'] = ImageService::uploadFile($data['anh_dai_dien'], $type, config('images.paths.' . $type));
        }

        return $this->create($data);
    }

    public function updateGiaoVien($request, $id)
    {
        $giaoVien = $this->findOrFail($id);
        
        $data = $request->all();
      
        if (isset($data['anh_dai_dien'])) {
            $type = 'teacher_avatar';
            $data['anh_dai_dien'] = ImageService::uploadFile($data['anh_dai_dien'], $type, config('images.paths.' . $type));
        }

        return $this->update($data,$id);
    }

}
