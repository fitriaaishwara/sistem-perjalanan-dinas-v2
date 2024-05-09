<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_perjalanan', 'kegiatan', 'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class, 'id_perjalanan', 'id');
    }

    public function dataKegiatan()
    {
        return $this->hasMany(DataKegiatan::class, 'id_kegiatan', 'id');
    }

    public function uploadLaporan()
    {
        return $this->hasMany(UploadLaporan::class, 'id_kegiatan', 'id');
    }

}
