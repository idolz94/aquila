<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaiChinh extends Model
{
    protected $table = 'tai_chinhs';

    protected $fillable = [
        'hoc_vien_id', 
        'tong_ngay_ngi', 
        'tong_ngay_co_mat',
        'ghi_chu', 
        'thang', 
    ];
    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }
}
