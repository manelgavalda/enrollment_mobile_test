<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Scool\Foundation\User as ScoolUser;
use Spatie\Permission\Traits\HasRoles;

class User extends ScoolUser
{
    use HasApiTokens, HasRoles;
}