<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbmTiket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sbm_tiket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('province_id', 2);
            $table->unsignedInteger('id_golongan');
            $table->foreignUuid('id_jabatan_struktural')->nullable();
            $table->string('nominal', 50);
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('status')->default(1);

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_golongan')->references('id')->on('golongan');
            $table->foreign('id_jabatan_struktural')->references('id')->on('jabatan_struktural');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sbm_tiket');
    }
}
