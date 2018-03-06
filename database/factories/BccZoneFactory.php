<?php

use Faker\Generator as Faker;

$factory->define(App\BccZone::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->streetName,
        'address' => $faker->streetAddress
    ];
});
