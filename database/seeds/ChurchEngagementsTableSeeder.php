<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChurchEngagementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();

        $church_engagements = [
            ['name' => 'Choir', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Sanitation', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Usher', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Security', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Protocol', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Crowd control', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Traffic', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Technical', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Hospitality', 'created_at' => $now, 'updated_at' => $now ],
        ];

        DB::table('church_engagements')->insert($church_engagements);

        echo "...done\n";
    }
}
