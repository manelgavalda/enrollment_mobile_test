<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Enrollment::class, function (Faker\Generator $faker) {
    //    static $password;

    return [
        'name' => $faker->name,
        'validated' => $faker->boolean,
        'finished' => $faker->boolean, //indica si la matricula està finalitzada.
        'study_id' => $faker->randomDigit,
        'classroom_id' => $faker->randomDigit,
        'course_id' => $faker->randomDigit,
        'user_id' => 1
    ];
});
