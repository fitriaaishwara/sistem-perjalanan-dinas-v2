<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKegiatanPerjalanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kegiatan_perjalanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_perjalanan');
            $table->foreignUuid('id_tujuan');
            $table->string('nip_staff');
            $table->foreignUuid('id_kegiatan');

            $table->boolean('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_perjalanan')->references('id')->on('perjalanan');
            $table->foreign('id_tujuan')->references('id')->on('data_tujuan_perjalanan');
            $table->foreign('id_kegiatan')->references('id')->on('kegiatan');

            // Assuming 'nip_staff' is a foreign key referencing 'nip' in 'staff'
            $table->foreign('nip_staff')->references('nip')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_kegiatan_perjalanan');
    }
}
