<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perjalanan extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'perjalanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_mak', 'perihal_perjalanan', 'estimasi_biaya', 'description', 'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function mak()
    {
        return $this->belongsTo(Mak::class, 'id_mak', 'id');
    }

    public function tujuan()
    {
        return $this->hasMany(Tujuan::class, 'id_perjalanan', 'id');
    }




}
