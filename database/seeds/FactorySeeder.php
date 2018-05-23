<?php

use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BccZone::class, 10)->create();

        factory(App\Family::class, 10)->create()->each(function ($family) {
            $occupations = [
                'Lawyer', 'Doctor', 'Teacher', 'Stylist', 'Barber'
            ];

            $faker = Faker\Factory::create();

            $family->members()->create([
                'first_name' => $faker->firstName,
                'middle_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'phones' => [$faker->phoneNumber],
                'gender' => $faker->randomElement(['M', 'F']),
                'age_group' => $faker->randomElement(['1', '2', '3', '4']),
                'member_role_id' => \App\MemberRole::whereName('Head')->first()->id,
                'marital_status' => $faker->randomElement(['1', '2', '3', '4', '5', '6']),
                'occupation' => $faker->randomElement($occupations),
            ]);

        });

        factory(App\Member::class, 30)->create();

        echo "...done\n";
    }
}
