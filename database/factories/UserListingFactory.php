<?php

use Faker\Generator as Faker;

$factory->define(Everlytic\Models\UserListing::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'position' => $faker->jobTitle
    ];
});
