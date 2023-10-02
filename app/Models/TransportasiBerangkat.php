<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportasiBerangkat extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'transportasi_berangkat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_transportasi',
        'id_staff_perjalanan',
        'dokumen',
        'jenis_dokumen',
        'nominal',
        'ukuran_file',
    ];

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'id_transportasi', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(DataStaffPerjalanan::class, 'id_staff_perjalanan', 'id');
    }
}
