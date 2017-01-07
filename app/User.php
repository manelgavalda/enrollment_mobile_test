<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
//use Scool\Foundation\User as ScoolUser;
use Spatie\Permission\Traits\HasRoles;

//class User extends ScoolUser
/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}

