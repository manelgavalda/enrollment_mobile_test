<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Department::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
