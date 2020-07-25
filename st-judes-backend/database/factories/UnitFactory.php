<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Unit::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->sentence,
    ];
});
