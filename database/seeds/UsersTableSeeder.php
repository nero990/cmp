<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'System',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        echo "...done\n";
    }
}
