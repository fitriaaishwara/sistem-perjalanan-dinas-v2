<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusPerjalanan extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'status_perjalanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status_perjalanan','id_status','created_by','updated_by','deleted_by',
    ];

    public function log_status_perjalanan()
    {
        return $this->hasMany(LogStatusPerjalanan::class, 'id_status_perjalanan', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }

    public function perjalanan()
    {
        return $this->hasMany(Perjalanan::class, 'id_status_perjalanan', 'id');
    }
}
