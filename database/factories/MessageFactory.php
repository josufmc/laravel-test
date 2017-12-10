<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {

    return [
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mensaje' => $faker->sentence,
    ];
});
