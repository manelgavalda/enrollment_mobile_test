<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Course::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
