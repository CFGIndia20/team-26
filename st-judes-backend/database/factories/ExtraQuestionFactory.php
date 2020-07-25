<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ExtraQuestion::class, function (Faker $faker) {
    return [
        'unit_id' => \App\Unit::all()->random()->first()->id,
        'question_id' => \App\Question::all()->random()->first()->id,
    ];
});
