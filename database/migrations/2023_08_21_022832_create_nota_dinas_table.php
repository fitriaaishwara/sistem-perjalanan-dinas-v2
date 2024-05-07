<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_dinas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_perjalanan');
            $table->string('nip_staff_penandatangan');
            $table->string('nomor_nota_dinas');
            $table->string('yth');
            $table->string('dari');
            $table->string('perihal');
            $table->date('tanggal_nota_dinas');
            $table->text('isi_nota_dinas');
            $table->string('status_nota_dinas')->nullable();
            $table->string('lampiran')->nullable();
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');
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
        Schema::dropIfExists('nota_dinas');
    }
}
