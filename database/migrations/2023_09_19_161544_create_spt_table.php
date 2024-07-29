<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spt', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_tujuan')->nullable();
            $table->string('nip_staff');
            $table->string('nip_staff_penandatangan')->nullable();
            $table->string('nomor_spt');
            $table->date('dikeluarkan_tanggal');
            $table->string('file_spt')->nullable();
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tujuan')->references('id')->on('data_tujuan_perjalanan');
            $table->foreign('nip_staff')->references('nip')->on('staff')->onDelete('cascade');
            $table->foreign('nip_staff_penandatangan')->references('nip')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spt');
    }
}
