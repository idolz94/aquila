<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuKien extends Model
{

    protected $table = 'su_kiens';

    protected $fillable = [
        'ten', 
        'ngay_bat_dau', 
        'ngay_ket_thuc',
        'noi_dung', 
        'ket_qua', 
        'ma_mau', 
    ];
    public function hocvien()
    {
        return $this->belongsToMany('App\Models\HocVien','su_kien_hoc_vien')->withTimestamps();
    }
}
