<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminsTableSeeder::class);
         $this->call(StatesTableSeeder::class);
         $this->call(MemberRolesTableSeeder::class);
         $this->call(ChurchEngagementsTableSeeder::class);
         $this->call(SacramentQuestionsTableSeeder::class);
         $this->call(FactorySeeder::class);
         $this->call(MicroSeeder::class);
    }
}
