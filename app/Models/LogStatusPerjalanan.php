<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogStatusPerjalanan extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    protected $table = 'log_status_perjalanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_perjalanan', 'status_perjalanan', 'description', 'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function status_perjalanan()
    {
        return $this->belongsTo(StatusPerjalanan::class, 'id_status_perjalanan', 'id');
    }

    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class, 'id_perjalanan', 'id');
    }
}
