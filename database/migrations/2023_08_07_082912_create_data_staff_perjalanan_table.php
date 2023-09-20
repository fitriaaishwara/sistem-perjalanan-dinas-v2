<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataStaffPerjalananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_staff_perjalanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_staff');
            $table->foreignUuid('id_perjalanan');
            $table->foreignUuid('id_tujuan_perjalanan');
            $table->boolean('status')->default (1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_staff')->references('id')->on('staff');
            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');
            $table->foreign('id_tujuan_perjalanan')->references('id')->on('data_tujuan_perjalanan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_staff_perjalanan');
    }
}
