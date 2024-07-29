<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
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
                'id' => '828fc769-3f31-4e8a-9d72-f7a88acd1831',
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('12345678'),
                'is_active' => true,
            ],

            1 => [
                'id' => 'f7a88acd1831-3f31-4e8a-9d72-828fc769',
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'is_active' => true,

            ],

        ];

            User::insert($data);
    }
}
