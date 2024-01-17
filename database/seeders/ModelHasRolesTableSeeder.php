<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
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
                'role_id' => '1',
                'model_type' => 'App\Models\User',
                'model_id' => '828fc769-3f31-4e8a-9d72-f7a88acd1831',
            ],
        ];

        \DB::table('model_has_roles')->insert($data);
    }
}
