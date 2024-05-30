<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spd extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'spd';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_staff_perjalanan',
        'id_kegiatan',
        'nomor_spd',
        'pejabat_pembuat_komitmen',
        'tingkat_biaya_perjalanan_dinas',
        'alat_angkutan',
        'keterangan',
        'pada_tanggal',
        'created_by',
        'updated_by',
        'deleted_by'

    ];

    public function data_staff_perjalanan()
    {
        return $this->belongsTo(DataStaffPerjalanan::class, 'id_staff_perjalanan', 'id');
    }
}
