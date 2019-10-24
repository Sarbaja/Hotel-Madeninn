<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //check IsAdmin
    const ADMIN_ROLE = 1;
    const DEFAULT_ROLE = 0;

    //check isActive
    const USER_ACTIVE = 1;
    const USER_INACTIVE = 0;

    public function isAdmin()
    {
        return $this->role === self::ADMIN_ROLE;
    }
    public function isActive()
    {
        return $this->status === self::USER_ACTIVE;
    }


}

