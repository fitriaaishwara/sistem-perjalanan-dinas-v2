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
            ],

            1 => [
                'id' => 2,
                'name' => 'Kepala Bidang',
            ],

            2 => [
                'id' => 3,
                'name' => 'JFT Ahli Muda',
            ],

            3 => [
                'id' => 4,
                'name' => 'JFT Pranata Komputer',
            ],

            4 => [
                'id' => 5,
                'name' => 'Analis Kebijakan',
            ],

            5 => [
                'id' => 6,
                'name' => 'Pelaksana',
            ],

        ];
        Jabatan::insert($data);
    }
}
