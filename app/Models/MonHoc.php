<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'mon_hocs';

    protected $fillable = [
        'mon_hoc', 
        'bo_mon_id', 
        'giao_vien_id', 
        'ngay_hoc',
        'ngay_ket_thuc', 
        'loai_hinh', 
        'giai_doan', 
        'do_kho',
    ];

    public function bomon()
    {
        return $this->belongsTo('App\Models\BoMon','bo_mon_id');
    }

    public function lophoc()
    {
        return $this->hasOne('App\Models\LopHoc');
    } 




}
