<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogStatusPerjalananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_status_perjalanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_perjalanan');
            $table->string('status_perjalanan')->nullable();
            $table->string('description')->nullable();
            $table->string('direvisi_oleh')->nullable();
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_status_perjalanan');
    }
}
