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

    function perjalanan() {
        return $this->belongsTo(Perjalanan::class, 'id_perjalanan', 'id');
    }

    function staff() {
        return $this->belongsTo(Staff::class, 'id_staff_penandatangan', 'id');
    }

    function data_staff() {
        return $this->belongsTo(DataStaffPerjalanan::class, 'id_perjalanan', 'id');
    }


}
