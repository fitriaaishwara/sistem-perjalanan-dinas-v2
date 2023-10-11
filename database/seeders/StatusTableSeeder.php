<?php

namespace Database\Seeders;

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
                'id' => Str::uuid(),
                'province_id' => '11',
                'nominal' => '360000',
            ],
        ];

        UangHarian::insert($data);
    }
}
