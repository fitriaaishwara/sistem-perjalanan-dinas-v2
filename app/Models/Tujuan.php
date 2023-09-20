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
        'id_perjalanan', 'tempat_berangkat', 'tempat_tujuan', 'tanggal_berangkat', 'tanggal_pulang', 'tanggal_tiba', 'lama_perjalanan', 'status'
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
}
