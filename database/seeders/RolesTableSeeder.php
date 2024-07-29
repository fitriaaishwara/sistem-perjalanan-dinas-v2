<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            1 => [
                'id' => '2',
                'name' => 'Asisten Deputi',
                'guard_name' => 'web',
            ],
            2 => [
                'id' => '3',
                'name' => 'Kepala Bidang',
                'guard_name' => 'web',
            ],
            3 => [
                'id' => '4',
                'name' => 'Staff',
                'guard_name' => 'web',
            ],
            4 => [
                'id' => '5',
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
        ];

        \DB::table('roles')->insert($data);

    }
}
