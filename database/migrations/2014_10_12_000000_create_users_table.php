<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 70);
            $table->string('password', 255);
            $table->string('person_type', 30);
            $table->unsignedInteger('person_id');
            $table->dateTime('last_logged_in')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['username', 'person_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
