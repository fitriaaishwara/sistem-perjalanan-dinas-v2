<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Geotaging extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'geo_tagging';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'id_data_staff_perjalanan', 'image_path', 'latitude', 'longitude', 'address', 'status'
    ];

    public function dataStaffPerjalanan()
    {
        return $this->hasOne(DataStaffPerjalanan::class, 'id_staff_perjalanan', 'id');
    }
}
