<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Seeder;

class InstansiTableSeeder extends Seeder
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
                'name' => 'Kementerian Koperasi dan UMKM',
            ],
            1 => [
                'id' => 2,
                'name' => 'Lainnya',
            ],

        ];

            Instansi::insert($data);
    }
}
