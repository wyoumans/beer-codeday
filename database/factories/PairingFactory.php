<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pairing;
use Faker\Generator as Faker;

$factory->define(Pairing::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(rand(3, 7)),
    ];
});
