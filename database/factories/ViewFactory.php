<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\View;

$factory->define(View::class, function (Faker $faker) {
    return [

        'ip' => $faker->ipv4()
    ];
});
