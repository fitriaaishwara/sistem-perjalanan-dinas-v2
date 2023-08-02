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
            $table->id();
            $table->foreignUuid('id_staff');
            $table->foreignUuid('id_perjalanan');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_staff')->references('id')->on('staff');
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
        Schema::dropIfExists('data_staff_perjalanan');
    }
}
