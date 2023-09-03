<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaDinas extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'nota_dinas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_perjalanan', 'id_staff_penandatangan', 'nomor_nota_dinas', 'yth', 'dari', 'perihal', 'tanggal_nota_dinas', 'isi_nota_dinas', 'status_nota_dinas', 'status_nota_dinas', 'created_by', 'updated_by', 'deleted_by',
    ];
}
