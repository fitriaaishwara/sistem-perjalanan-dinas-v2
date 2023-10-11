<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangHarian extends Model
{
    use HasFactory, Uuid;

    protected $table = 'uang_harian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'province_id', 'nominal'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
