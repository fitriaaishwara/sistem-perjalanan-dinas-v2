<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_staff_perjalanan')->nullable();
            $table->string('nomor_spd')->nullable();
            $table->foreignUuid('id_kegiatan');
            $table->string('pejabat_pembuat_komitmen');
            $table->string('tingkat_biaya_perjalanan_dinas')->nullable();
            $table->string('alat_angkutan')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('pada_tanggal')->nullable();
            $table->string('file_spd')->nullable();

            $table->boolean('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('id_staff_perjalanan')->references('id')->on('data_staff_perjalanan')->onDelete('cascade');
            $table->foreign('id_kegiatan')->references('id')->on('kegiatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spd');
    }
}
