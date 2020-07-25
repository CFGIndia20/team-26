<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'unit_id' => \App\Unit::all()->random()->first()->id,
        'question_text' => $faker->sentence,
        'minimum_rating' => rand(0,5)
    ];
});
