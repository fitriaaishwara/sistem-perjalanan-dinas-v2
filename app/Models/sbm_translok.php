<?php
namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sbm_translok extends Model
{
    use HasFactory;
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'sbm_translok';
    protected $primaryKey = 'id';

}
