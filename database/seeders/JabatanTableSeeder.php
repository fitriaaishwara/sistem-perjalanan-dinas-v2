<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JabatanTableSeeder extends Seeder
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
                'id' => 1,
                'name' => 'Asisten Deputi Pemetaan Data dan Analis Usaha',
                'id_jabatan_struktural' => 4,
            ],

            1 => [
                'id' => 2,
                'name' => 'Kepala Bidang',
                'id_jabatan_struktural' => null,
            ],

            2 => [
                'id' => 3,
                'name' => 'JFT Ahli Muda',
                'id_jabatan_struktural' => null,
            ],

            3 => [
                'id' => 4,
                'name' => 'JFT Pranata Komputer',
                'id_jabatan_struktural' => null,
            ],

            4 => [
                'id' => 5,
                'name' => 'Analis Kebijakan',
                'id_jabatan_struktural' => null,
            ],

            5 => [
                'id' => 6,
                'name' => 'Pelaksana',
                'id_jabatan_struktural' => null,
            ],

        ];
        Jabatan::insert($data);
    }
}
