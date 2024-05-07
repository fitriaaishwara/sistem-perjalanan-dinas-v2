<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
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
                    'name' => 'Dashboard',
                    'guard_name' => 'web',
                ],

                1 => [
                    'id' => '2',
                    'name' => 'Data Staff',
                    'guard_name' => 'web',
                ],

                2 => [
                    'id' => '3',
                    'name' => 'Data Jabatan',
                    'guard_name' => 'web',
                ],

                3 => [
                    'id' => '4',
                    'name' => 'Mata Anggaran Akun',
                    'guard_name' => 'web',
                ],

                4 => [
                    'id' => '5',
                    'name' => 'Pengajuan',
                    'guard_name' => 'web',
                ],

                5 => [
                    'id' => '6',
                    'name' => 'Data Perjalanan',
                    'guard_name' => 'web',
                ],

                6 => [
                    'id' => '7',
                    'name' => 'Nota Dinas',
                    'guard_name' => 'web',
                ],

                7 => [
                    'id' => '8',
                    'name' => 'SPT',
                    'guard_name' => 'web',
                ],

                8 => [
                    'id' => '9',
                    'name' => 'SPD',
                    'guard_name' => 'web',
                ],

                9 => [
                    'id' => '10',
                    'name' => 'Bukti Invoice',
                    'guard_name' => 'web',
                ],

                10 => [
                    'id' => '11',
                    'name' => 'Laporan',
                    'guard_name' => 'web',
                ],

                11 => [
                    'id' => '12',
                    'name' => 'Gallery Foto',
                    'guard_name' => 'web',
                ],

                12 => [
                    'id' => '13',
                    'name' => 'Kwitansi',
                    'guard_name' => 'web',
                ],

                13 => [
                    'id' => '14',
                    'name' => 'Role',
                    'guard_name' => 'web',
                ],

                14 => [
                    'id' => '15',
                    'name' => 'User',
                    'guard_name' => 'web',
                ],

                15 => [
                    'id' => '16',
                    'name' => 'Data Rekap ',
                    'guard_name' => 'web',
                ],

                16 => [
                    'id' => '17',
                    'name' => 'Data SBM',
                    'guard_name' => 'web',
                ],

                17 => [
                    'id' => '18',
                    'name' => 'Kartu Kredit Pemerintah',
                    'guard_name' => 'web',
                ],

            ];

            \DB::table('permissions')->insert($data);
    }
}
