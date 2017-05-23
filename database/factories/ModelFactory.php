<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Manelgavalda\EnrollmentMobileTest\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'person_id' => 1,
        'enrollment_id' => 1,
        //'api_token'      => str_random(60),
        'remember_token' => str_random(10),

    ];
});

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Manelgavalda\EnrollmentMobileTest\Task::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->sentence,
        'done'     => $faker->boolean(),
        'priority' => $faker->randomDigit,
    ];
});
