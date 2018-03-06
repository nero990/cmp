<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    $occupations = [
        'Lawyer', 'Doctor', 'Teacher', 'Stylist', 'Barber'
    ];
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'phones' => $faker->phoneNumber,
        'family_id' => App\Family::all()->random()->id,
        'gender' => $faker->randomElement(['M', 'F']),
        'age_group' => $faker->randomElement(['1', '2', '3', '4']),
        'member_role_id' => \App\MemberRole::where('name', '<>', 'Head')->get()->random()->id,
        'marital_status' => $faker->randomElement(['1', '2', '3', '4', '5', '6']),
        'occupation' => $faker->randomElement($occupations),
    ];
});
