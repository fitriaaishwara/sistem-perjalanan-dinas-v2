<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTujuanPerjalananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tujuan_perjalanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_perjalanan');
            $table->char('tempat_berangkat_id', 2);
            $table->char('tempat_tujuan_id', 2);
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->date('tanggal_tiba');
            $table->string('lama_perjalanan')->nullable();
            $table->integer('total_biaya')->default(0);
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');
            $table->foreign('tempat_berangkat_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tempat_tujuan_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_tujuan_perjalanan');
    }
}
