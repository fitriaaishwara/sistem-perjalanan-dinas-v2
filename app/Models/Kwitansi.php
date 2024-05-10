<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kwitansi extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'kwitansi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_staff_perjalanan', 'nip_bendahara', 'nip_pejabat_pembuat_komitmen', 'bukti_kas_nomor', 'tahun_anggaran', 'sudah_diterima_dari'
    ];

    public function dataStaffPerjalanan()
    {
        return $this->hasOne(DataStaffPerjalanan::class, 'id_staff_perjalanan', 'id');
    }

    function bendahara() {
        return $this->belongsTo(Staff::class, 'id_bendahara', 'id');
    }

    function pejabatPembuatKomitmen() {
        return $this->belongsTo(Staff::class, 'id_pejabat_pembuat_komitmen', 'id');
    }

}
