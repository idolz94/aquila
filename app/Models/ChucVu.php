<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    protected $table = 'chuc_vus';

    protected $fillable = [
        'ten',
    ];
 


    public function chucvu()
    {
        return $this->hasOne('App\Models\GiaoVien');
    }
}
