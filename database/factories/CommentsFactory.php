<?php

use Faker\Generator as Faker;

$factory->define(App\Comments::class, function (Faker $faker) {
    return [
        'message' => $faker->realText($maxNbChars = 2500)
    ];
});
