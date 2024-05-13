<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusTableSeeder extends Seeder
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
                'status_surat' => 'Naskah Masuk',
            ],

            1 => [
                'id' => '2',
                'status_surat' => 'Naskah Proses',
            ],

            2 => [
                'id' => '3',
                'status_surat' => 'Naskah Selesai',
            ],

            3 => [
                'id' => '4',
                'status_surat' => 'Naskah Ditolak',
            ],

        ];
        Status::insert($data);
    }
}
