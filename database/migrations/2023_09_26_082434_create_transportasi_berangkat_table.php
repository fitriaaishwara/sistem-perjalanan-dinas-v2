<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportasiBerangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportasi_berangkat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_transportasi');
            $table->foreignUuid('id_staff_perjalanan');
            $table->string('file_path');
            $table->string('deskripsi_file');
            $table->string('nominal');
            $table->string('ukuran_file')->nullable();
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_transportasi')->references('id')->on('transportasi');
            $table->foreign('id_staff_perjalanan')->references('id')->on('data_staff_perjalanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportasi_berangkat');
    }
}
