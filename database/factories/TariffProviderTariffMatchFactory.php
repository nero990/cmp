<?php

use Faker\Generator as Faker;

$factory->define(App\TariffProviderTariffMatch::class, function (Faker $faker) {
    $users = App\User::all();

    return [
        'tarrif_id' => $faker->randomDigit,
        'provider_tarrif_id' => $faker->randomDigit,
        'user_id' => $users->random()->id,
        'active_status' => $faker->randomElement(['ACTIVE', 'PENDING', 'DELETED']),
    ];
});
