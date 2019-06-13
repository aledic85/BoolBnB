<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Sponsored::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'price' => $faker->numberBetween(5, 10),
        'end_sponsored' => $faker->dateTime()
    ];
});
