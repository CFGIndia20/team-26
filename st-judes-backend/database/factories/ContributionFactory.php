<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Contribution::class, function (Faker $faker) {
    return [
        'donor_id' => \App\Donor::all()->random()->id,
        'description' => $faker->sentence,
        'amount' => $faker->numberBetween(2000, 4000),
        'start_date' => Carbon\Carbon::now()->subDays(30)->format('Y-m-d'),
        'end_date' => Carbon\Carbon::now()->subDays(10)->format('Y-m-d'),
        'admin_feedback' => $faker->sentence,
    ];
});
