<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberSacramentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_sacrament_detail', function (Blueprint $table) {
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('sacrament_detail_id');
            $table->string('response', 255);
            $table->date('year')->nullable();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('sacrament_detail_id')->references('id')->on('sacrament_details')->onDelete('cascade');

            $table->unique(['member_id', 'sacrament_detail_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_sacrament_detail');
    }
}