<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgayHocVien extends Model
{
    protected $table = 'anh_hoc_viens';

    protected $fillable = [
        'hoc_vien_id', 
        'ngay_tron', 
        'ngay_tro_lai', 
        'noi_dung', 
        'ly_do', 
    ];

    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }
}
