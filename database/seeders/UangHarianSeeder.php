<?php

namespace Database\Seeders;

use App\Models\UangHarian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UangHarianSeeder extends Seeder
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
                'id' => Str::uuid(),
                'province_id' => '11',
                'nominal' => '360000',
            ],
            1 => [
                'id' => Str::uuid(),
                'province_id' => '12',
                'nominal' => '370000',
            ],
            2 => [
                'id' => Str::uuid(),
                'province_id' => '13',
                'nominal' => '380000',
            ],
            3 => [
                'id' => Str::uuid(),
                'province_id' => '14',
                'nominal' => '370000',
            ],
            4 => [
                'id' => Str::uuid(),
                'province_id' => '15',
                'nominal' => '370000',
            ],
            5 => [
                'id' => Str::uuid(),
                'province_id' => '16',
                'nominal' => '380000',
            ],
            6 => [
                'id' => Str::uuid(),
                'province_id' => '17',
                'nominal' => '380000',
            ],
            7 => [
                'id' => Str::uuid(),
                'province_id' => '18',
                'nominal' => '380000',
            ],
            8 => [
                'id' => Str::uuid(),
                'province_id' => '19',
                'nominal' => '410000',
            ],
            9 => [
                'id' => Str::uuid(),
                'province_id' => '21',
                'nominal' => '370000',
            ],
            10 => [
                'id' => Str::uuid(),
                'province_id' => '31',
                'nominal' => '530000',
            ],
            11 => [
                'id' => Str::uuid(),
                'province_id' => '32',
                'nominal' => '430000',
            ],
            12 => [
                'id' => Str::uuid(),
                'province_id' => '33',
                'nominal' => '370000',
            ],
            13 => [
                'id' => Str::uuid(),
                'province_id' => '34',
                'nominal' => '420000',
            ],
            14 => [
                'id' => Str::uuid(),
                'province_id' => '35',
                'nominal' => '410000',
            ],
            15 => [
                'id' => Str::uuid(),
                'province_id' => '36',
                'nominal' => '370000',
            ],
            16 => [
                'id' => Str::uuid(),
                'province_id' => '51',
                'nominal' => '480000',
            ],
            17 => [
                'id' => Str::uuid(),
                'province_id' => '52',
                'nominal' => '440000',
            ],
            18 => [
                'id' => Str::uuid(),
                'province_id' => '53',
                'nominal' => '430000',
            ],
            19 => [
                'id' => Str::uuid(),
                'province_id' => '61',
                'nominal' => '380000',
            ],
            20 => [
                'id' => Str::uuid(),
                'province_id' => '62',
                'nominal' => '360000',
            ],
            21 => [
                'id' => Str::uuid(),
                'province_id' => '63',
                'nominal' => '370000',
            ],
            22 => [
                'id' => Str::uuid(),
                'province_id' => '64',
                'nominal' => '430000',
            ],
            23 => [
                'id' => Str::uuid(),
                'province_id' => '65',
                'nominal' => '430000',
            ],
            24 => [
                'id' => Str::uuid(),
                'province_id' => '71',
                'nominal' => '370000',
            ],
            25 => [
                'id' => Str::uuid(),
                'province_id' => '72',
                'nominal' => '370000',
            ],
            26 => [
                'id' => Str::uuid(),
                'province_id' => '73',
                'nominal' => '430000',
            ],
            27 => [
                'id' => Str::uuid(),
                'province_id' => '74',
                'nominal' => '380000',
            ],
            28 => [
                'id' => Str::uuid(),
                'province_id' => '75',
                'nominal' => '370000',
            ],
            29 => [
                'id' => Str::uuid(),
                'province_id' => '76',
                'nominal' => '410000',
            ],
            30 => [
                'id' => Str::uuid(),
                'province_id' => '81',
                'nominal' => '380000',
            ],
            31 => [
                'id' => Str::uuid(),
                'province_id' => '82',
                'nominal' => '430000',
            ],
            32 => [
                'id' => Str::uuid(),
                'province_id' => '91',
                'nominal' => '480000',
            ],
            33 => [
                'id' => Str::uuid(),
                'province_id' => '94',
                'nominal' => '580000',
            ],

        ];

        UangHarian::insert($data);
    }
}
