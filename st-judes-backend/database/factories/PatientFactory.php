<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Patient::class, function (Faker $faker) {
    return [
        'centre_id' => \App\Centre::all()->random()->id,
        'phone_number' => $faker->numberBetween(8888888888, 1000000000),
        'admission_start_date' => Carbon\Carbon::now()->subDays(30)->format('Y-m-d'),
        'admission_end_date' => Carbon\Carbon::now()->subDays(10)->format('Y-m-d'),
    ];
});
