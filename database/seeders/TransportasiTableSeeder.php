<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransportasiTableSeeder extends Seeder
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
                'name' => 'Pesawat',
            ],

            1 => [
                'id' => Str::uuid(),
                'name' => 'Kereta Api',
            ],

            2 => [
                'id' => Str::uuid(),
                'name' => 'Bus/Mobil',
            ],

            3 => [
                'id' => Str::uuid(),
                'name' => 'Kapal Laut',
            ],

            4 => [
                'id' => Str::uuid(),
                'name' => 'Kendaraan Dinas',
            ],

            5 => [
                'id' => Str::uuid(),
                'name' => 'Kendaraan Pribadi',
            ],

            6 => [
                'id' => Str::uuid(),
                'name' => 'Taksi',
            ],

            7 => [
                'id' => Str::uuid(),
                'name' => 'Taksi Online
                ',
            ],

            8 => [
                'id' => Str::uuid(),
                'name' => 'Lainnya',
            ],
        ];

        \App\Models\Transportasi::insert($data);
    }
}
