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
            $table->foreignUuid('nomor_spd')->nullable();
            $table->string('pejabat_pembuat_komitmen');
            $table->string('tingkat_biaya_perjalanan_dinas')->nullable();
            $table->string('alat_angkutan')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('pada_tanggal')->nullable();
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
