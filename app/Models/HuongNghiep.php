<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuongNghiep extends Model
{
    protected $table = 'huong_nghieps';

    protected $fillable = [
        'ten',
        'ngay_bat_dau', 
        'ngay_ket_thuc',
    ];
    public function hocvien()
    {
        return $this->belongsToMany('App\Models\HocVien','huong_nghiep_hoc_vien')->withTimestamps();
    }
}
