<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mak extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'mak';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_mak', 'saldo_awal_pagu', 'saldo_pagu', 'description',
    ];
}
