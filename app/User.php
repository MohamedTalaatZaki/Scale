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
        'full_name', 'email', 'password' ,'user_name' ,'employee_number' ,'lang' ,'theme' , 'avatar' , 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',

    ];

    protected $appends  =   ['avatar_url'];

    public function getAvatarUrlAttribute() {
        $avatar =   is_null($this->avatar) ? asset('/img/default-user.png') : asset( '/storage/'.$this->avatar);
        return $this->attributes['avatar']  =  $avatar;
    }
}
