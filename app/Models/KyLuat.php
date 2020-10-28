<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KyLuat extends Model
{
    protected $table = 'ky_luats';

    protected $fillable = [
        'hoc_vien_id', 
        'ngay', 
        'ly_do', 
        'ghi_chu', 
    ];
    public function hanhkiem()
    {
        return $this->belongsTo('App\Models\HocVien','hoc_vien_id');
    }
}
