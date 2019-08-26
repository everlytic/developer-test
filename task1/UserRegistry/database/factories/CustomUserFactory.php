<?php

use Faker\Generator as Faker;

$factory->define(App\CustomUser::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt($faker->password),
        'position' => $faker->jobTitle,
    ];
});
