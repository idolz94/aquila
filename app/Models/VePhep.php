<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VePhep extends Model
{
    
    protected $table = 've_pheps';

    protected $fillable = [
        'hoc_vien_id', 
        'tinh_trang', 
        'ngay_ve',
        'ngay_vao',
        'thang_ve',
        'thang_vao',
        'ghi_chu' ,
        'ly_do' ,
    ];
    
    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    } 
}
