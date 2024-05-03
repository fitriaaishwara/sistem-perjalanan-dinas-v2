<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nd_tembusan extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'nd_tembusan';
    protected $primaryKey = 'id';

    function nota_dinas() {
        return $this->belongsTo(NotaDinas::class, 'id_nota_dinas', 'id');
    }
}
