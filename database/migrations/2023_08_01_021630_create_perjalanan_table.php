<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjalananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjalanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_mak');
            $table->string('perihal perjalanan');
            $table->string('tempat_berangkat');
            $table->string('tempat_tujuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->date('tanggal_tiba');
            $table->string('lama_perjalanan')->nullable();
            $table->string('estimasi_biaya');
            $table->string('description')->nullable();
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_mak')->references('id')->on('mak');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perjalanan');
    }
}
