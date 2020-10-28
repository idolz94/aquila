<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhTrangNghien extends Model
{
    protected $table = 'tinh_trang_nghien';

    protected $fillable = [
        'hoc_vien_id', 
        'cac_benh_kem_theo', 
        'thuong_xuyen_su_dung',
        'co_dia_di_ung',
        'gia_dinh_ai_nghien'
    ];
    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }
}
