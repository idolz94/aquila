<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrungTam extends Model
{
    protected $table = 'trung_tams';

    protected $fillable = [
        'hoc_vien_id', 
        'ngay_vao', 
        'ngay_ra',
        'tiep_nhan_chua',
        'muc_do' ,
        'bap_tiem_nuoc' ,
        'phong_id' ,
    ];
    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    } 
}
