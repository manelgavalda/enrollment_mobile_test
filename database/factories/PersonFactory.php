<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Person::class, function (Faker\Generator $faker) {
    //    static $password;

    return [
        'username' => $faker->name,
        'email' => $faker->name,
        'tsi' => $faker->name,
        'birth_date' => $faker->dateTime,
        'name' => $faker->name,
        'dni' => $faker->name,
        'location' => $faker->name,
        'sex' => $faker->name,
        'telephone' => $faker->phoneNumber,
        'mobile_phone' => $faker->phoneNumber,
        'first_surname' => $faker->name,
        'second_surname' => $faker->name,
        'personal_email' => $faker->name,
        'postal_code' => $faker->name,
        'user_id' => 1
    ];
});

