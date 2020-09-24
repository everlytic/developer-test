<?php

use Faker\Generator as Faker;
use App\User;



$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make($faker->password()),
        'position' => $faker->jobTitle,
    ];
});
