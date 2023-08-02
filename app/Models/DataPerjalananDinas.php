<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerjalananDinas extends Model
{
    use HasFactory;

    protected $table = 'data_perjalanan_dinas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_status_perjalanan',
        'id_transportasi_berangkat',
        'id_transportasi_pulang',
        'id_penginapan',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($model) {
            $model->data_staff_perjalanan()->delete();
        });
    }

    function data_staff_perjalanan()
    {
        return $this->hasMany(DataStaffPerjalanan::class, 'id_perjalanan', 'id');
    }

    function penginapan()
    {
        return $this->hasOne(Penginapan::class, 'id', 'id_penginapan');
    }

    function transportasi_berangkat()
    {
        return $this->hasOne(TransportasiBerangkat::class, 'id', 'id_transportasi_berangkat');
    }

    function transportasi_pulang()
    {
        return $this->hasOne(TransportasiPulang::class, 'id', 'id_transportasi_pulang');
    }
}
