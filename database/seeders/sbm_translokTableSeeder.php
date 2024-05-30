<?php

namespace Database\Seeders;

use App\Models\sbm_hotel;
use App\Models\sbm_translok;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class sbm_translokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            11 => 'ACEH',
            12 => 'SUMATERA UTARA',
            13 => 'SUMATERA BARAT',
            14 => 'RIAU',
            15 => 'JAMBI',
            16 => 'SUMATERA SELATAN',
            17 => 'BENGKULU',
            18 => 'LAMPUNG',
            19 => 'KEPULAUAN BANGKA BELITUNG',
            21 => 'KEPULAUAN RIAU',
            31 => 'DKI JAKARTA',
            32 => 'JAWA BARAT',
            33 => 'JAWA TENGAH',
            34 => 'DI YOGYAKARTA',
            35 => 'JAWA TIMUR',
            36 => 'BANTEN',
            51 => 'BALI',
            52 => 'NUSA TENGGARA BARAT',
            53 => 'NUSA TENGGARA TIMUR',
            61 => 'KALIMANTAN BARAT',
            62 => 'KALIMANTAN TENGAH',
            63 => 'KALIMANTAN SELATAN',
            64 => 'KALIMANTAN TIMUR',
            65 => 'KALIMANTAN UTARA',
            71 => 'SULAWESI UTARA',
            72 => 'SULAWESI TENGAH',
            73 => 'SULAWESI SELATAN',
            74 => 'SULAWESI TENGGARA',
            75 => 'GORONTALO',
            76 => 'SULAWESI BARAT',
            81 => 'MALUKU',
            82 => 'MALUKU UTARA',
            91 => 'PAPUA BARAT',
            94 => 'PAPUA'
        ];

        $data = [];

        foreach ($provinces as $province_id => $province_name) {
            for ($i = 1; $i <= 4; $i++) {
                $data[] = [
                    'id' => Str::uuid(),
                    'province_id' => $province_id,
                    'id_golongan' => $i,
                    'id_jabatan_struktural' => $i,
                    'nominal' => $this->generateNominal($i),
                    'status' => '1'
                ];
            }
        }

        sbm_translok::insert($data);
    }

    private function generateNominal($id_golongan)
    {
        switch ($id_golongan) {
            case 1:
                return '816000';
            case 2:
                return '816000';
            case 3:
                return '816000';
            case 4:
                return '8294000';
            case 5:
                return '8420000';
            case 6:
                return '3560000';
            case 7:
                return '1294000';
            case 8:
                return '816000';
            default:
                return '0';
        }
    }
}
