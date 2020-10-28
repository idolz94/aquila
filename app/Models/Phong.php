<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    protected $table = 'phongs';

    protected $fillable = [
        'hoc_vien_id', 
        'ten_phong', 
        'vi_tri',
        'ten_truong_phong', 
        'ghi_chu',
        'ngay_ghi_chu',
    ];

    public function hocvien()
    {
        return $this->belongsToMany('App\Models\HocVien','phong_hoc_viens')->withPivot('ly_do','type')->withTimestamps();
    } 
    
    public function truongphong()
    {
        return $this->belongsTo('App\Models\HocVien','ten_truong_phong'); 
    }
}
