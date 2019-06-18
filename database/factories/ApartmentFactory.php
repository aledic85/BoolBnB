<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Apartment::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->sentence(),
        'rooms' => $faker->numberBetween(2, 6),
        'beds' => $faker->numberBetween(1, 5),
        'bathrooms' => $faker->numberBetween(1, 4),
        'mq' => $faker->numberBetween(80, 300),
        'latitude' => $faker->latitude(),
        'longitude' => $faker->longitude(),
        'img_path' => $faker->imageUrl(),
        'wi_fi' => $faker->boolean(),
        'parking_space' => $faker->boolean(),
        'pool' => $faker->boolean(),
        'sauna' => $faker->boolean(),
        'active' => $faker->boolean(),
    ];
});
