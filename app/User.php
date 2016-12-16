<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Scool\Foundation\User as ScoolUser;

class User extends ScoolUser
{
    use HasApiTokens;
}
