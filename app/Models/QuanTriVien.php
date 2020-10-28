<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanTriVien extends Model
{
    protected $table = 'quan_tri_viens';

    protected $fillable = [
        'ten', 
        'email', 
        'password',
        'phan_quyen', 
    ];

}
