<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $table = 'status';
    protected $primaryKey = 'id';

    protected $fillable = [
        'status_surat',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function status_perjalanan()
    {
        return $this->hasMany(StatusPerjalanan::class, 'id_status', 'id');
    }

}
