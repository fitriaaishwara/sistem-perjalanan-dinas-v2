<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataStaffPerjalanan extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'data_staff_perjalanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_perjalanan',
        'nip_staff',
        'id_tujuan_perjalanan',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function perjalanan()
    {
        return $this->hasMany(Perjalanan::class, 'id', 'id_perjalanan');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'nip_staff', 'nip');
    }

    public function spd()
    {
        return $this->hasOne(Spd::class, 'id_staff_perjalanan', 'id');
    }

    public function penandatangan()
    {
        return $this->hasMany(Spt::class, 'nip_staff_penandatangan', 'id');
    }

    public function tujuan_perjalanan()
    {
        return $this->hasMany(Tujuan::class, 'id', 'id_tujuan_perjalanan');
    }

    public function transportasi_berangkat()
    {
        return $this->hasMany(TransportasiBerangkat::class, 'id_staff_perjalanan', 'id');
    }

    public function transportasi_pulang()
    {
        return $this->hasMany(TransportasiPulang::class, 'id_staff_perjalanan', 'id');
    }

    public function akomodasi_hotel()
    {
        return $this->hasMany(AkomodasiHotel::class, 'id_staff_perjalanan', 'id');
    }

    public function kwitansi()
    {
        return $this->hasMany(Kwitansi::class, 'id_staff_perjalanan', 'id');
    }

    // public function data_uang_harian()
    // {
    //     return $this->hasMany(DataUangHarian::class, 'id_data_staff_perjalanan', 'id');
    // }

    public function geotaging()
    {
        return $this->hasMany(Geotaging::class, 'id_staff_perjalanan', 'id');
    }


}
