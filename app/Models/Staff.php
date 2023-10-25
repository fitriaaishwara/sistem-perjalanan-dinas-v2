<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user','id_jabatan','id_golongan','id_instansi','nip', 'jenis', 'name', 'description', 'status'
    ];

    public function golongans()
    {
        return $this->belongsTo(Golongan::class, 'id_golongan', 'id');
    }

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id');
    }

    public function instansis()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id');
    }

    public function kwitansiBendahara()
    {
        return $this->hasMany(Kwitansi::class, 'id_bendahara', 'id');
    }

    public function kwitansiPejabat()
    {
        return $this->hasMany(Kwitansi::class, 'id_pejabat_pembuat_komitmen', 'id');
    }

    public function dataStaffPerjalanan()
    {
        return $this->hasMany(DataStaffPerjalanan::class, 'id_staff', 'id');
    }

    public function nota_dinas()
    {
        return $this->hasMany(NotaDinas::class, 'id_staff_penandatangan', 'id');
    }







}
