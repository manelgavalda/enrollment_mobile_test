
<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Scool\EnrollmentMobile\Models\Module::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});