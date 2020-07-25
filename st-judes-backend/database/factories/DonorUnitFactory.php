<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Centre;
use App\Donor;
use App\Model;
use App\Unit;
use Faker\Generator as Faker;

$factory->define(\App\DonorUnit::class, function (Faker $faker) {
    return [
        'donor_id' => Donor::all()->random()->id,
        'unit_id' => Unit::all()->random()->id,
        'centre_id' => Centre::all()->random()->id,
        'contribution_id' => \App\Contribution::all()->random()->id,
    ];
});
