<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSickMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sick_members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->enum('type', ['1', '2', '3', '4'])->comment('1 => Accident, 2 => Health related, 3 => Aged, 4 => others');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sick_members');
    }
}
