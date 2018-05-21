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
        \App\Family::all()->each(function($family) use($faker) {
            if($family->type == "1") {
                $names = [];
                for($i = 0; $i <= $faker->numberBetween(1, 4); $i++) {
                    $names[] = $faker->firstName;
                }

                $family->names_of_children = $names;
                $family->save();
            }
        });
    }
}
