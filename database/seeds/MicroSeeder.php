<?php

use Illuminate\Database\Seeder;

class MicroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        \App\Member::all()->each(function($member) use($faker) {

            $phones = [];
            for($i = 0; $i <= $faker->numberBetween(1, 2); $i++) {
                $phones[] = $faker->phoneNumber;
            }
            $member->phones = $phones;
            $member->save();
        });
    }
}
