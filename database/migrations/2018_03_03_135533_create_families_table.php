<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('registration_number', 50)->unique();
            $table->string('password', 255);
            $table->rememberToken();
            $table->enum('type', ['1', '2'])->comment('1 => Family, 2 => Individual');
            $table->integer('number_of_children')->default(0);
            $table->unsignedInteger('state_id')->nullable()->comment('Family state of origin');
            $table->text('address')->nullable();
            $table->enum('card_status', ['0', '1', '2'])->default('0')->comment('0 => Not Paid, 1 => Paid, 2 => Collected');
            $table->unsignedInteger('bcc_zone_id')->nullable();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('bcc_zone_id')->references('id')->on('bcc_zones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}
