<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhQuaTrinh extends Model
{
    protected $table = 'anh_qua_trinh';

    protected $fillable = [
        'hoc_vien_id', 
        'anh_hoc_vien', 
    ];

    public function hocvien()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }
}
