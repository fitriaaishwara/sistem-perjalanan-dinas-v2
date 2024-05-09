<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tujuan extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'data_tujuan_perjalanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_perjalanan', 'id_uang_harian','tempat_berangkat_id', 'tempat_tujuan_id', 'tanggal_berangkat', 'tanggal_pulang', 'tanggal_tiba', 'lama_perjalanan', 'status'
    ];

    public function perjalanan()
    {
        return $this->hasOne(Perjalanan::class, 'id', 'id_perjalanan');
    }

    public function spt()
    {
        return $this->hasMany(Spt::class, 'id_tujuan', 'id');
    }

    public function staff()
    {
        return $this->hasMany(DataStaffPerjalanan::class, 'id_tujuan_perjalanan', 'id');
    }

    public function uploadLaporan()
    {
        return $this->hasOne(UploadLaporan::class, 'id_tujuan_perjalanan', 'id');
    }

    public function uploadGallery()
    {
        return $this->hasMany(UploadGallery::class, 'id_tujuan_perjalanan', 'id');
    }

    public function tempatBerangkat()
    {
        return $this->belongsTo(Province::class, 'tempat_berangkat_id', 'id');
    }

    public function tempatTujuan()
    {
        return $this->belongsTo(Province::class, 'tempat_tujuan_id', 'id');
    }

    public function uangHarian()
    {
        return $this->belongsTo(UangHarian::class, 'id_uang_harian', 'province_id');
    }

    public function DataKegiatan()
    {
        return $this->hasMany(DataKegiatan::class, 'id_tujuan', 'id');
    }


}
