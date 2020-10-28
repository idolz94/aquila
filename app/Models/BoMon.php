<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoMon extends Model
{
    
    protected $table = 'bo_mons';

    protected $fillable = [
        'ten_bo_mon', 
    ];

    public function monhoc()
    {
        return $this->hasMany('App\Models\MonHoc');
    } 
}
