<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();

        $states = [
            ['code' => 'AB', 'name' => 'Abia', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AD', 'name' => 'Adamawa', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AK', 'name' => 'Akwa Ibom', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AN', 'name' => 'Anambra', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BA', 'name' => 'Bauchi', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BY', 'name' => 'Bayelsa', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BE', 'name' => 'Benue', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BO', 'name' => 'Borno', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CR', 'name' => 'Cross River', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DE', 'name' => 'Delta', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EB', 'name' => 'Ebonyi', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ED', 'name' => 'Edo', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EK', 'name' => 'Ekiti', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EN', 'name' => 'Enugu', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GO', 'name' => 'Gombe', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IM', 'name' => 'Imo', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'JI', 'name' => 'Jigawa', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KD', 'name' => 'Kaduna', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KN', 'name' => 'Kano', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KT', 'name' => 'Katsina', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KE', 'name' => 'Kebbi', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KO', 'name' => 'Kogi', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KW', 'name' => 'Kwara', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LA', 'name' => 'Lagos', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NA', 'name' => 'Nassarawa', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NI', 'name' => 'Niger', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'OG', 'name' => 'Ogun', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ON', 'name' => 'Ondo', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'OS', 'name' => 'Osun', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'OY', 'name' => 'Oyo', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PL', 'name' => 'Plateau', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'RI', 'name' => 'Rivers', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SO', 'name' => 'Sokoto', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TA', 'name' => 'Taraba', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'YO', 'name' => 'Yobe', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ZA', 'name' => 'Zamfara', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FC', 'name' => 'Abuja', 'created_at' => $now, 'updated_at' => $now]
        ];

        DB::table('states')->insert($states);

        echo "...done\n";
    }
}
