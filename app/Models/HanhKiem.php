<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HanhKiem extends Model
{
    protected $table = 'hanh_kiems';

    protected $fillable = [
        'hoc_vien_id', 
        'ten_hanh_kiem', 
        'so_lan',
        'ngay', 
        'ly_do', 
        'ghi_chu', 
    ];
    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }

   
}
