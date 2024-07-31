<?php

namespace Database\Seeders;

use App\Models\sbm_hotel;
use App\Models\sbm_tiket;
use App\Models\sbm_translok;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class sbm_tiketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //banda aceh
        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 11,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4492000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //medan - sumut
        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 12,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //padang - sumbar
        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 13,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2952000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //pekanbaru - riau
        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 14,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3016000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //jambi - jambi
        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 15,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2460000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //sumatera selatan - palembang
        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 16,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //bengkulu - bengkulu
        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 17,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2621000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //lampung - bandar lampung
        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 18,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 1583000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kepulauan bangka belitung - pangkal pinang
        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 19,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2139000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kepulauan riau - tanjung pinang
        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 1,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 2,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 1,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 2,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 3,
        //     'id_jabatan_struktural' => 4,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 21,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        //jakarta - dki jakarta
        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 1,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 2,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 1,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 2,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 3,
        //     'id_jabatan_struktural' => 4,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 31,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        //jabar - bandung
        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 1,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 2,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 1,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 2,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 3,
        //     'id_jabatan_struktural' => 4,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 32,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        //jateng - semarang
        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 33,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //diy - yogyakarta
        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 34,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2268000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //jatim - surabaya
        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 35,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2674000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //banten - serang
        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 1,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 2,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 1,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 2,
        //     'id_jabatan_struktural' => null,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 3,
        //     'id_jabatan_struktural' => 4,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        // sbm_tiket::create([
        //     'province_id' => 36,
        //     'id_golongan' => 4,
        //     'id_jabatan_struktural' => 3,
        //     'nominal' => 2268000,
        //     'status' => 1,
        //     'created_by' => Auth::id(),
        // ]);

        //bali - denpasar
        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 51,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3262000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //ntb - mataram
        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 52,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3230000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //ntt - kupang
        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 53,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 5081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kalbar - pontianak
        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 61,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2781000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kalteng - palangkaraya
        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 62,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2984000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kalsel - banjarmasin
        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 63,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 2995000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kaltim - samarinda
        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 64,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3797000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //kaltara - tanjung selor
        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 65,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4057000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //sulawesi utara - manado
        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 71,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 5102000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //sulaesi tengah - palu
        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 72,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 5113000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //sulawesi selatan - makassar
        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 73,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 3829000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //sulawesi tenggara - kendari
        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 74,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4182000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //gorontalo - gorontalo
        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 75,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //sulawesi barat - mamuju
        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 76,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 4867000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //maluku - ambon
        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 81,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 7081000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //maluku utara - ternate
        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 82,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 6664000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //papua barat - manokwari
        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 91,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 10824000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        //papua - jayapura
        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 1,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 2,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 1,
            'id_jabatan_struktural' => null,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 2,
            'id_jabatan_struktural' => null,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 3,
            'id_jabatan_struktural' => 4,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

        sbm_tiket::create([
            'province_id' => 94,
            'id_golongan' => 4,
            'id_jabatan_struktural' => 3,
            'nominal' => 8193000,
            'status' => 1,
            'created_by' => Auth::id(),
        ]);

    }
}
