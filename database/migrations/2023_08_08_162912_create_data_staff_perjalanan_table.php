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
            $table->string('nip_staff');
            $table->foreignUuid('id_tujuan_perjalanan');
            $table->string('id_perjalanan');
            $table->integer('total_biaya')->default(0);
            $table->boolean('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tujuan_perjalanan')->references('id')->on('data_tujuan_perjalanan');

            // Assuming 'nip_staff' is a foreign key referencing 'nip' in 'staff'
            $table->foreign('nip_staff')->references('nip')->on('staff');
            // Assuming 'id_kegiatan' is a foreign key referencing 'id' in 'kegiatan'

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
