<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChurchEngagementMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_engagement_member', function (Blueprint $table) {
            $table->unsignedInteger('church_engagement_id');
            $table->unsignedInteger('member_id');

            $table->foreign('church_engagement_id')->references('id')->on('church_engagements');
            $table->foreign('member_id')->references('id')->on('members');

            $table->unique(['church_engagement_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('church_engagement_member');
    }
}
