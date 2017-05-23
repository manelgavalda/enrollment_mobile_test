<?php

namespace Manelgavalda\EnrollmentMobileTest;

use Scool\Foundation\User as ScoolUser;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Manelgavalda\EnrollmentMobileTest\Notifications\ResetPassword;
use Scool\EnrollmentMobile\Models\Enrollment;
use Spatie\Permission\Traits\HasRoles;

//class User extends ScoolUser
/**
 * Class User
 * @package App
 */
class User extends ScoolUser
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'enrollment_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }
}

