<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhomCha extends Model
{
    protected $table = 'nhom_chas';
    
    protected $fillable = [
        'ten', 
    ];

    public function nhom()
    {
        return $this->hasOne('App\Models\Nhom');
    }
}
