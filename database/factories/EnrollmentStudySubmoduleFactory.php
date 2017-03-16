<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\EnrollmentStudySubmodule::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'enrollment_id' => $faker->randomDigit,
        'study_submodule_id' => $faker->randomDigit,
    ];
});
