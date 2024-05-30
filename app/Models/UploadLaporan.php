<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadLaporan extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'upload_laporan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tujuan_perjalanan', 'name_file', 'path_file'
    ];


    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }

}
