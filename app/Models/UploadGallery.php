<?php

namespace App\Models;

use App\Traits\Uuid;
use CreateDataTujuanPerjalananTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadGallery extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'upload_gallery';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tujuan_perjalanan', 'name_file', 'path_file'
    ];


    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class, 'id_tujuan_perjalanan', 'id');
    }

}
