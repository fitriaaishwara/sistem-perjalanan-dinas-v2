<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'spt';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tujuan', 'nip_staff', 'nip_staff_penandatangan', 'nomor_spt', 'dikeluarkan_tanggal',
    ];

    public function tujuan()
    {
        return $this->hasMany(Tujuan::class, 'id_tujuan', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(DataStaffPerjalanan::class, 'nip_staff', 'id');
    }

    public function staff_penandatangan()
    {
        return $this->belongsTo(Staff::class, 'nip_staff_penandatangan', 'nip');
    }
}
