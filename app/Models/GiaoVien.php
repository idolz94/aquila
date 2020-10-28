<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiaoVien extends Model
{
    protected $table = 'giao_viens';

    protected $fillable = [
        'ten', 
        'email', 
        'he_phai_id',
        'chuc_vu_id', 
        'quoc_gia', 
        'ngay_sinh', 
        'doi_tac', 
        'so_dien_thoai', 
        'anh_dai_dien', 
        'nguoi_gioi_thieu', 
        'ghi_chu', 
    ];
 

    public function LopHoc()
    {
        return $this->hasMany('App\Models\LopHoc');
    }
   
    public function chucvu()
    {
        return $this->belongsTo('App\Models\ChucVu','chuc_vu_id');
    }

    public function hephai()
    {
        return $this->belongsTo('App\Models\HePhai','he_phai_id');
    }

}
