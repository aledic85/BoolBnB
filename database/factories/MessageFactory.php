<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
      'name' => $faker->firstName(),
      'lastname' => $faker->lastName(),
      'email' => $faker->unique()->safeEmail(),
      'title' => $faker->sentence(),
      'content' => $faker->sentence(),
    ];
});
