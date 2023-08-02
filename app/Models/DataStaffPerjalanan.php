<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStaffPerjalanan extends Model
{
    use HasFactory;

    protected $table = 'data_staff_perjalanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_perjalanan',
        'id_staff',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    function perjalanan()
    {
        return $this->hasOne(DataPerjalananDinas::class, 'id', 'id_perjalanan');
    }

    function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id');
    }
}
