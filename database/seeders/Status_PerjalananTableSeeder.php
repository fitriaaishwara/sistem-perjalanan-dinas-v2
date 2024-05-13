<?php

namespace Database\Seeders;

use App\Models\StatusPerjalanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Status_PerjalananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            0 => [
                'id' => '1',
                'status_perjalanan' => 'Belum Disetujui - Asisten Deputi Pemetaan Data',
                'id_status' => '1',
            ],

            1 => [
                'id' => '2',
                'status_perjalanan' => 'Belum Disetujui - Kepala Bidang Pemetaan Data dan Analisis',
                'id_status' => '1',
            ],

            2 => [
                'id' => '3',
                'status_perjalanan' => 'Ditolak - Asisten Deputi Pemetaan Data',
                'id_status' => '4',
            ],

            4 => [
                'id' => '5',
                'status_perjalanan' => 'Disetujui - Asisten Deputi Pemetaan Data',
                'id_status' => '2',
            ],

            5 => [
                'id' => '6',
                'status_perjalanan' => 'SPT dan SPD Terbit - Staff Sedang Dalam Perjalanan',
                'id_status' => '2',
            ],

            6 => [
                'id' => '7',
                'status_perjalanan' => 'Staff Belum Upload Bukti Invoice dan Laporan',
                'id_status' => '2',
            ],

            7 => [
                'id' => '8',
                'status_perjalanan' => 'Staff Belum Upload Bukti Invoice',
                'id_status' => '2',
            ],

            8 => [
                'id' => '9',
                'status_perjalanan' => 'Staff Belum Upload Laporan',
                'id_status' => '2',
            ],

            9 => [
                'id' => '10',
                'status_perjalanan' => 'Staff Sudah Upload Bukti Invoice dan Laporan',
                'id_status' => '2',
            ],

            10 => [
                'id' => '11',
                'status_perjalanan' => 'Kwitansi Terbit',
                'id_status' => '2',
            ],

            11 => [
                'id' => '12',
                'status_perjalanan' => 'Sudah Dibayar',
                'id_status' => '3',
            ],



        ];

        StatusPerjalanan::insert($data);
    }
}
