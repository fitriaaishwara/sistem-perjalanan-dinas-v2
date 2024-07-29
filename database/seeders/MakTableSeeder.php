<?php

namespace Database\Seeders;

use App\Models\Mak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MakTableSeeder extends Seeder
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
                'kode_mak' => '4457.QMA.001.051.A.524111',
                'saldo_awal_pagu' => '100000000',
                'saldo_pagu' => '100000000',
                'terealisasi' => '0',
                'status' => '1'
            ]

        ];

            Mak::insert($data);
    }
}
