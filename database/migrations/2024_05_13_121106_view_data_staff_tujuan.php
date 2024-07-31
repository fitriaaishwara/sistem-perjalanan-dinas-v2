<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ViewDataStaffTujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  DB::statement('CREATE VIEW datastafftujuan AS
        //     SELECT data_staff_perjalanan.id AS data_staff_id,
        //         data_staff_perjalanan.id_staff,
        //         data_staff_perjalanan.id_tujuan_perjalanan,
        //         data_staff_perjalanan.total_biaya AS staff_total_biaya,
        //         data_staff_perjalanan.status AS data_staff_status,
        //         staff.id AS staff_id,
        //         staff.id_user,
        //         staff.id_jabatan,
        //         staff.id_golongan,
        //         staff.id_instansi,
        //         staff.nip AS staff_nip,
        //         staff.jenis AS staff_jenis,
        //         staff.name AS staff_name,
        //         staff.status AS staff_status,
        //         data_tujuan_perjalanan.id AS tujuan_id,
        //         data_tujuan_perjalanan.id_perjalanan,
        //         data_tujuan_perjalanan.id_uang_harian,
        //         data_tujuan_perjalanan.tempat_berangkat_id,
        //         data_tujuan_perjalanan.tempat_tujuan_id,
        //         data_tujuan_perjalanan.tanggal_berangkat,
        //         data_tujuan_perjalanan.tanggal_pulang,
        //         data_tujuan_perjalanan.tanggal_tiba,
        //         data_tujuan_perjalanan.lama_perjalanan,
        //         data_tujuan_perjalanan.total_biaya AS tujuan_total_biaya,
        //         data_tujuan_perjalanan.status AS tujuan_status
        //     FROM data_staff_perjalanan
        //     INNER JOIN staff ON staff.nip = data_staff_perjalanan.id_staff
        //     INNER JOIN data_tujuan_perjalanan ON data_tujuan_perjalanan.id = data_staff_perjalanan.id_tujuan_perjalanan');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP VIEW datastafftujuan');
    }
}
