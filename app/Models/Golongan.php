<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Golongan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'golongan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'id_golongan', 'id');
    }

}
