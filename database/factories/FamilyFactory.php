<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(\App\Family::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'registration_number' => $faker->unique()->randomNumber(),
        'type' => $faker->randomElement(['1', '2']),
        'number_of_children' => 0,
        'state_id' => \App\State::all()->random()->id,
        'address' => $faker->streetAddress,
        'card_status' => '0',
        'bcc_zone_id' => \App\BccZone::all()->random()->id
    ];
});
