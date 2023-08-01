<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPerjalananDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_perjalanan_dinas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_staff');
            $table->foreignUuid('id_perjalanan');
            $table->foreignUuid('id_status_perjalanan');
            $table->foreignUuid('id_transportasi_berangkat');
            $table->foreignUuid('id_transportasi_pulang');
            $table->foreignUuid('id_penginapan');
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_staff')->references('id')->on('staff');
            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');
            $table->foreign('id_status_perjalanan')->references('id')->on('status_perjalanan');
            $table->foreign('id_transportasi_berangkat')->references('id')->on('transportasi_berangkat');
            $table->foreign('id_transportasi_pulang')->references('id')->on('transportasi_pulang');
            $table->foreign('id_penginapan')->references('id')->on('penginapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_perjalanan_dinas');
    }
}
