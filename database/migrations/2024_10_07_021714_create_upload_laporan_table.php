<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_laporan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_kegiatan');
            $table->string('name_file');
            $table->string('path_file');

            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_kegiatan')->references('id')->on('kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_laporan');
    }
}
