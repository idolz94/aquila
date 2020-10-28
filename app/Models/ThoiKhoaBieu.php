<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThoiKhoaBieu extends Model
{
    protected $table = 'thoi_khoa_bieus';

    protected $fillable = [
        'sang',
        'chieu',
        'ngay',
        'lop_hoc_id',
    ];

    public function lophoc()
    {
        return $this->belongsToMany('App\Models\LopHoc','lop_hoc_id');
    } 

  



}
