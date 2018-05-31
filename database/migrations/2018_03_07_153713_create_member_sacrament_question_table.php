<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberSacramentQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_sacrament_question', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedInteger('member_id');
            $table->unsignedInteger('sacrament_question_id');
            $table->boolean('response');
            $table->date('year')->nullable();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('sacrament_question_id')->references('id')->on('sacrament_questions')->onDelete('cascade');

            $table->unique(['member_id', 'sacrament_question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_sacrament_question');
    }
}
