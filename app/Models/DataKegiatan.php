<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataKegiatan extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $table = 'data_kegiatan_perjalanan';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id_perjalanan',
        'id_tujuan',
        'nip_staff',
        'id_kegiatan',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

}
