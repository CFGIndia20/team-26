<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\QuestionResponse::class, function (Faker $faker) {
    return [
        'patient_id' => \App\Patient::all()->random()->first()->id,
        'question_id' => \App\Question::all()->random()->first()->id,
        'rating' => rand(0,5),
    ];
});
