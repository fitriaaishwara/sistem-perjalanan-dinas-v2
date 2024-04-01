<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class IndoRegionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);
        $this->call(IndoRegionVillageSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(JabatanTableSeeder::class);
        $this->call(GolonganTableSeeder::class);
        $this->call(InstansiTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(UangHarianSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(TransportasiTableSeeder::class);
        $this->call(MakTableSeeder::class);

    }
}
