<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_user')->nullable();
            $table->foreignUuid('id_jabatan')->nullable();
            $table->unsignedInteger('id_golongan')->nullable();
            $table->unsignedInteger('id_instansi')->nullable();
            $table->string('nip')->unique();
            $table->string('jenis');
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_jabatan')->references('id')->on('jabatan');
            $table->foreign('id_golongan')->references('id')->on('golongan');
            $table->foreign('id_instansi')->references('id')->on('instansi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
