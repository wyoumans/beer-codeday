<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'edamam_id' => $faker->md5,
        'url' => $faker->url,
        'label' => $faker->sentence(rand(3, 7)),
        'source' => $faker->sentence(rand(15, 20)),
        'image_url' => $faker->imageUrl,
        'share_url' => $faker->url,
    ];
});
