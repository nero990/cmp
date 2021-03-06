
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBccZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcc_zones', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 70)->unique();
            $table->text('address');
            $table->text('streets');
            $table->enum('status', ['0', '1'])->default('0')->comment('0 => Inactive, 1 => Active');
            $table->unsignedInteger('uploaded_file_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uploaded_file_id')->references('id')->on('uploaded_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bcc_zones');
    }
}
