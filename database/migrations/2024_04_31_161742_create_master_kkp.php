<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKkp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kkp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_staff_perjalanan');
            $table->foreignUuid('id_perjalanan');
            $table->foreignUuid('id_sbm_tiket');
            $table->foreignUuid('id_sbm_hotel');
            $table->foreignUuid('id_sbm_translok');
            $table->foreignUuid('id_akomodasi_hotel');

            $table->boolean('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_staff_perjalanan')->references('id')->on('data_staff_perjalanan');
            $table->foreign('id_sbm_tiket')->references('id')->on('sbm_tiket');
            $table->foreign('id_sbm_hotel')->references('id')->on('sbm_hotel');
            $table->foreign('id_sbm_translok')->references('id')->on('sbm_translok');
            $table->foreign('id_akomodasi_hotel')->references('id')->on('akomodasi_hotel');
            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kkp');
    }
}
