<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DienGiaiTaiChinh extends Model
{
    protected $table = 'dien_giai_tai_chinhs';

    protected $fillable = [
        'ten_dien_giai', 
        'thu_chi',
    ];
}
