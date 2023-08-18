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
                'nip' => '1234567890',
                'jenis' => '0',
                'name' => 'Stefani Siregar',

            ],
            1 => [
                'id' => Str::uuid(),
                'nip' => '1234567891',
                'jenis' => '0',
                'name' => 'Rizky Ramadhan',

            ],
            2 => [
                'id' => Str::uuid(),
                'nip' => '1234567892',
                'jenis' => '0',
                'name' => 'Budiman Fajar',
            ],
            3 => [
                'id' => Str::uuid(),
                'nip' => '1234567893',
                'jenis' => '0',
                'name' => 'Kevin Pratama',
            ],
            4 => [
                'id' => Str::uuid(),
                'nip' => '1234567894',
                'jenis' => '0',
                'name' => 'Sandi Pratama',
            ],
            5 => [
                'id' => Str::uuid(),
                'nip' => '1234567895',
                'jenis' => '1',
                'name' => 'Jessica Siregar',
            ],
            6 => [
                'id' => Str::uuid(),
                'nip' => '1234567896',
                'jenis' => '1',
                'name' => 'Farhan Ramadhan',
            ],
            7 => [
                'id' => Str::uuid(),
                'nip' => '1234567897',
                'jenis' => '1',
                'name' => 'Budi Fajar',
            ],
            8 => [
                'id' => Str::uuid(),
                'nip' => '1234567898',
                'jenis' => '1',
                'name' => 'Kevin Hart',
            ],
            9 => [
                'id' => Str::uuid(),
                'nip' => '1234567899',
                'jenis' => '1',
                'name' => 'Sandi Hart',
            ],
            10 => [
                'id' => Str::uuid(),
                'nip' => '1234567800',
                'jenis' => '2',
                'name' => 'Lisa Hernandez',
            ],
            11 => [
                'id' => Str::uuid(),
                'nip' => '1234567801',
                'jenis' => '2',
                'name' => 'Jennie Kim',
            ],
            12 => [
                'id' => Str::uuid(),
                'nip' => '1234567802',
                'jenis' => '2',
                'name' => 'Roseanne Park',
            ],
            13 => [
                'id' => Str::uuid(),
                'nip' => '1234567803',
                'jenis' => '2',
                'name' => 'Kim Jisoo',
            ],
            14 => [
                'id' => Str::uuid(),
                'nip' => '1234567804',
                'jenis' => '2',
                'name' => 'Park Chaeyoung',
            ],
            15 => [
                'id' => Str::uuid(),
                'nip' => '1234567805',
                'jenis' => '3',
                'name' => 'Jennie Hernandez',
            ],
            16 => [
                'id' => Str::uuid(),
                'nip' => '1234567806',
                'jenis' => '3',
                'name' => 'Kim Taehyung',
            ],
            17 => [
                'id' => Str::uuid(),
                'nip' => '1234567807',
                'jenis' => '3',
                'name' => 'Park Jimin',
            ],
            18 => [
                'id' => Str::uuid(),
                'nip' => '1234567808',
                'jenis' => '3',
                'name' => 'Kim Namjoon',
            ],
            19 => [
                'id' => Str::uuid(),
                'nip' => '1234567809',
                'jenis' => '3',
                'name' => 'Min Yoongi',
            ],
            20 => [
                'id' => Str::uuid(),
                'nip' => '1234567810',
                'jenis' => '1',
                'name' => 'Harry Styles',
            ],
            21 => [
                'id' => Str::uuid(),
                'nip' => '1234567811',
                'jenis' => '2',
                'name' => 'Louis Tomlinson',
            ],
            22 => [
                'id' => Str::uuid(),
                'nip' => '1234567812',
                'jenis' => '3',
                'name' => 'Niall Horan',
            ],
            23 => [
                'id' => Str::uuid(),
                'nip' => '1234567813',
                'jenis' => '3',
                'name' => 'Liam Payne',
            ],
            24 => [
                'id' => Str::uuid(),
                'nip' => '1234567814',
                'jenis' => '3',
                'name' => 'Zayn Malik',
            ],

        ];
        Staff::insert($data);

    }
}
