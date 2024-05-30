<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JabatanStruktural extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'jabatan_struktural';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public function sbm_tiket()
    {
        return $this->hasMany(sbm_tiket::class, 'id_jabatan_struktural', 'id');
    }

    public function sbm_hotel()
    {
        return $this->hasMany(sbm_hotel::class, 'id_jabatan_struktural', 'id');
    }

    public function sbm_translok()
    {
        return $this->hasMany(sbm_translok::class, 'id_jabatan_struktural', 'id');
    }
}
