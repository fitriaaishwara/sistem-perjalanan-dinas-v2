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
        'id_perjalanan', 'id_staff', 'status', 'description', 'created_by', 'updated_by', 'deleted_by',
    ];

}
