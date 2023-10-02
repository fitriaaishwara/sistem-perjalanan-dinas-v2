<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportasi extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'transportasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'jenis',
        'name',
        'description',
        'status'
    ];

    public function transportasi_berangkat()
    {
        return $this->hasMany(TransportasiBerangkat::class, 'id_transportasi', 'id');
    }
}
