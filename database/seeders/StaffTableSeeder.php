<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StaffTableSeeder extends Seeder
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
                'id_jabatan' => '1',
                'id_golongan' => '4',
                'id_instansi' => '1',
                'nip' => '196711121995031001',
                'jenis' => '0',
                'name' => 'Adi Trisnojuwono',

            ],

        ];
        Staff::insert($data);

    }
}
