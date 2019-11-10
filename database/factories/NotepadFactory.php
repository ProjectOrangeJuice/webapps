<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notepad;
use Faker\Generator as Faker;

$factory->define(Notepad::class, function (Faker $faker) {
    return [
        "content" =>  $faker->realText(500,3),
    ];
});
