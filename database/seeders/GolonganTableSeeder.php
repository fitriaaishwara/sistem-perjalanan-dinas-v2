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
            4 => [
                'id' => 5,
                'name' => 'Eselon I',
            ],
            5 => [
                'id' => 6,
                'name' => 'Eselon II',
            ],
            6 => [
                'id' => 7,
                'name' => 'Eselon III',
            ],
            7 => [
                'id' => 8,
                'name' => 'Eselon IV',
            ],
            8 => [
                'id' => 9,
                'name' => 'Eselon V',
            ],
        ];

        Golongan::insert($data);
    }
}
