<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberOfChildrenColumnToFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->json('names_of_children')->after('type')->nullable()->comment("Only children below 16yrs");
            $table->dropColumn('number_of_children');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropColumn('names_of_children');
            $table->addColumn('integer', 'number_of_children')->after('type')->default(0);
        });
    }
}
