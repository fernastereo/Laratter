<?php

use Faker\Generator as Faker;

$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'message' => $faker->words(4, true),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
