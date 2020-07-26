<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Donor::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'is_verified' => $faker->numberBetween(0, 2),
    ];
});
