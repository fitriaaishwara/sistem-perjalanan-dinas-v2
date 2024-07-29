<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwitansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kwitansi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_staff_perjalanan');
            $table->string('nip_bendahara');
            $table->string('nip_pejabat_pembuat_komitmen');
            $table->string('bukti_kas_nomor')->nullable();
            $table->string('tahun_anggaran')->nullable();
            $table->string('sudah_diterima_dari')->nullable();
            $table->string('file_kwitansi')->nullable();

            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_staff_perjalanan')->references('id')->on('data_staff_perjalanan');
            $table->foreign('nip_bendahara')->references('nip')->on('staff');
            $table->foreign('nip_pejabat_pembuat_komitmen')->references('nip')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kwitansi');
    }
}
