<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\JabatanStruktural;
use Illuminate\Database\Seeder;

class JabatanStrukturalSeeder extends Seeder
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
                'name' => 'Eselon I',
            ],
            1 => [
                'id' => 2,
                'name' => 'Eselon II',
            ],
            2 => [
                'id' => 3,
                'name' => 'Eselon III',
            ],
            3 => [
                'id' => 4,
                'name' => 'Eselon IV',
            ],
        ];
        JabatanStruktural::insert($data);
    }
}
