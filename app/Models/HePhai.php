<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HePhai extends Model
{
    protected $table = 'he_phais';

    protected $fillable = [
        'ten',
    ];
 

    public function chucvu()
    {
        return $this->hasOne('App\Models\GiaoVien');
    }
   
}
