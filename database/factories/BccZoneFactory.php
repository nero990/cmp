<?php

use Faker\Generator as Faker;

$factory->define(App\BccZone::class, function (Faker $faker) {
    $streets = [];
    $max = rand(3, 7);
    for ($i=0; $i < $max; $i++) {
        $streets[] = $faker->streetName;
    }

    return [
        'name' => $faker->unique()->streetName,
        'address' => $faker->streetAddress,
        'streets' => $streets,
        'status'  => '1'
    ];
});
