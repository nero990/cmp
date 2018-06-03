<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SacramentQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();

        $sacrament_questions = [
            ['question' => 'Are you baptized?', 'is_enabled' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'Are you confirmed?', 'is_enabled' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'Repented?', 'is_enabled' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['question' => 'Are you baptized by the Holy Spirit?', 'is_enabled' => '1', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('sacrament_questions')->insert($sacrament_questions);

        echo "...done\n";
    }
}

