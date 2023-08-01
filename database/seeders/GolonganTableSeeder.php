<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class GolonganTableSeeder extends Seeder
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
                'name' => 'I',
            ],
            1 => [
                'id' => 2,
                'name' => 'II',
            ],
            2 => [
                'id' => 3,
                'name' => 'III',
            ],
            3 => [
                'id' => 4,
                'name' => 'IV',
            ],
        ];

        Golongan::insert($data);
    }
}
