<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmailVerify;
use App\Notifications\EmailResetPassword;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Exception;

class NguoiBaoHo extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'nguoi_bao_hos';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'ten', 
        'email', 
        'password',
        'so_dien_thoai',
        'quan_he_hoc_vien',
    ];

    public function hocvien()
    {
        return $this->hasOne('App\Models\HocVien');
    } 

    public function baocao()
    {
        return $this->hasMany('App\Models\phong');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'nguoibaoho_id');
    }

    public function getGuard()
    {
        return 'nguoibaoho';
    }
}
