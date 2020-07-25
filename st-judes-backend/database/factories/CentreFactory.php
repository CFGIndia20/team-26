<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Centre::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'code' => $faker->randomDigit,
        'address' => $faker->address,
    ];
});
