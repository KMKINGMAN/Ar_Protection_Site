<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'first_name',
        'last_name',
        'username',
        'email',
        'image',
        'email_verified_at',
        'password',
        'facebook_link',
        'twitter_link',
        'instagram_link',
    ];

    public function getFirstNameAttribute($value): String {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value): String {
        return ucfirst($value);
    }

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
    ];
}
