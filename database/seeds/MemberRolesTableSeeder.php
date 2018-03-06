<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();

        $member_roles = [
            ['name' => 'Head', 'type' => '0', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Spouse', 'type' => '0', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Dependency', 'type' => '0', 'created_at' => $now, 'updated_at' => $now ],
        ];

        DB::table('member_roles')->insert($member_roles);

        echo "...done\n";
    }
}
