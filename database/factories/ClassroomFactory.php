<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Classroom::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'enrollment_id' => $faker->unique()->numberBetween($min = 1, $max = 20)
    ];
});
