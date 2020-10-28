<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhamSucKhoe extends Model
{
    protected $table = 'kham_suc_khoes';

    protected $fillable = [
        'hoc_vien_id', 
        'ten', 
        'noi_dung',
        'test_nhanh'
    ];
    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }
}
