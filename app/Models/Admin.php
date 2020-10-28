<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmailVerify;
use App\Notifications\EmailResetPassword;
use Illuminate\Notifications\DatabaseNotification;
use Exception;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'ten',
        'email',
        'password',
        'role',
        'gender',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role'
    ];

    public function getGuard()
    {
        return 'admin';
    }

    public function hasRole($role)
    {
        if ($this->getRole($this->role) == $role) {

            return true;
        }

        return false;
    }

    public function getRole($val)
    {
        $roles = config('admin.role');

        foreach ($roles as $role => $value) {
            if ($val == $value['val']) {
                
                return $role;
            }
        }

        return false;
    }

    public function getTextAttributeRole($val)
    {
        $roles = config('admin.role');

        foreach ($roles as $role => $value) {
            if ($val == $value['val']) {
                
                return $value['text'];
            }
        }

        return Null;
    }

    public function getTextAttributeGender($val)
    {
        $genders = config('admin.genders');

        foreach ($genders as $gender => $value) {
            if ($val == $value['val']) {
                
                return $value['text'];
            }
        }

        return Null;
    }
}
