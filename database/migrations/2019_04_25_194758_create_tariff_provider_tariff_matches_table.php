<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffProviderTariffMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff_provider_tariff_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("tarrif_id");
            $table->integer("provider_tarrif_id");
            $table->integer("user_id");
            $table->enum("active_status", ["ACTIVE", "PENDING", "DELETED"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariff_provider_tariff_matches');
    }
}
