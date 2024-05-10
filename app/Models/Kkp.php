<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kkp extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'master_kkp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_staff_perjalanan', 'id_perjalanan', 'id_sbm_tiket', 'id_sbm_hotel', 'id_sbm_translok', 'id_akomodassi_hotel'
    ];
}
