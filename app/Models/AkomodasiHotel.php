<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkomodasiHotel extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'akomodasi_hotel';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_staff_perjalanan',
        'nama_hotel',
        'file_path',
        'deskripsi_file',
        'tanggal_check_in',
        'tanggal_check_out',
        'nominal',
        'ukuran_file',
    ];

    public function staff()
    {
        return $this->belongsTo(DataStaffPerjalanan::class, 'id_staff_perjalanan', 'id');
    }
}
