<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nhom extends Model
{
    protected $table = 'nhoms';
    
    protected $fillable = [
        'ten', 
        'truong_nhom_id', 
        'ngay_bat_dau',
        'ngay_ket_thuc', 
        'ghi_chu',
        'ket_qua',
        'nhom_cha_id',
    ];

    public function hocvien()
    {
        return $this->belongsToMany('App\Models\HocVien','nhom_hoc_vien')->withTimestamps();
    }

    public function truongnhom()
    {
        return $this->belongsTo('App\Models\HocVien','truong_nhom_id');
    }

    public function nhomcha()
    {
        return $this->belongsTo('App\Models\NhomCha','nhom_cha_id');
    }
}
