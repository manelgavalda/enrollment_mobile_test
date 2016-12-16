<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Enrollment::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
    ];
});
