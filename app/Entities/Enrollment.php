<?php

namespace App\Entities;

use Acacha\Names\Traits\Nameable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Enrollment extends Model implements Transformable
{
    use TransformableTrait,Nameable;

    protected $fillable = ['name'];
com
}
