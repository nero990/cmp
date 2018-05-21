<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('age_group');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->enum('age_group', ['1', '2', '3', '4', '5', '6', '7', '8'])->after('gender')->comment('1 => 16-20, 2=>21-25, 3=>26-30, 4=>31-35, 5=>36-40, 6=>41-45, 7=>46-50, 8=>50 and above');
        });

        $faker = \Faker\Factory::create();
        \App\Member::all()->each(function($member) use($faker) {
            $member->age_group = $faker->numberBetween(1, 8);
            $member->save();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('age_group');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->enum('age_group', ['1', '2', '3', '4', '5', '6', '7', '8'])->after('gender')->comment('1 => 16-20, 2=>21-25, 3=>26-30, 4=>31-35, 5=>36-40, 6=>41-45, 7=>46-50, 8=>50 and above');
        });
    }
}
