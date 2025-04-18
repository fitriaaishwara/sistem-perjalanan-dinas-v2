<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sbm_hotel extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'sbm_hotel';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'province_id',
        'id_golongan',
        'nominal',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_golongan', 'id');
    }
}
