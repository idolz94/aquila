<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhLopHoc extends Model
{
    protected $table = 'anh_lop_hocs';

    protected $fillable = [
        'lop_hoc_id', 
        'anh_lop_hoc', 
    ];

    public function lophoc()
    {
        return $this->belongsTo('App\Models\LopHoc','lop_hoc_id');
    }
 
}
