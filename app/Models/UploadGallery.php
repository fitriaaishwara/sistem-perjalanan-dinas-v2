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
        'id_tujuan_perjalanan', 'id_data_kegiatan', 'name_file', 'path_file'
    ];


    public function tujuanPerjalanan()
    {
        return $this->belongsTo(CreateDataTujuanPerjalananTable::class, 'id_tujuan_perjalanan', 'id');
    }

}
