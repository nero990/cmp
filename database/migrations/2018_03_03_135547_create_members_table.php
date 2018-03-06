<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('email')->nullable();
            $table->text('phones')->nullable();
            $table->unsignedInteger('family_id');
            $table->enum('gender', ['M', 'F']);
            $table->enum('age_group', ['1', '2', '3', '4']);
            $table->unsignedInteger('member_role_id');
            $table->enum('marital_status', ['1', '2', '3', '4', '5', '6'])->comment('1 => Single, 2 => Married, 3 => Not Wedded, 4 => Divorced, 5 => Church Annulment 6 => Widowed');
            $table->string('occupation', 200)->nullable();
            $table->timestamps();

            $table->foreign('member_role_id')->references('id')->on('member_roles');
            $table->foreign('family_id')->references('id')->on('families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
