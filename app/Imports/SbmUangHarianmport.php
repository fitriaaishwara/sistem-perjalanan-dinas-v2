<?php

namespace App\Imports;

use App\Models\sbm_translok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SbmTranslokImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new sbm_translok([
            'province_id' => $row['province_id'],
            'id_golongan' => $row['id_golongan'],
            'id_jabatan_struktural' => $row['id_jabatan_struktural'],
            'nominal' => $row['nominal'],
            'status' => 1, // Default status, bisa disesuaikan
            'created_by' => auth()->user()->id, // Sesuaikan dengan user yang sedang login
            'updated_by' => auth()->user()->id, // Sesuaikan dengan user yang sedang login
        ]);
    }
}
