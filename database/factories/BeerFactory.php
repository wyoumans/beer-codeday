<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Beer;
use Faker\Generator as Faker;

$factory->define(Beer::class, function (Faker $faker) {
    return [
        'punk_id' => $faker->randomNumber,
        'name' => $faker->word,
        'tagline' => $faker->sentence(rand(3, 7)),
        'description' => $faker->sentence(rand(15, 20)),
        'image_url' => $faker->imageUrl,
        'abv' => $faker->randomFloat(2, 0, 15),
    ];
});
