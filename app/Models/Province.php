<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Province Model.
 */
class Province extends Model
{
    use ProvinceTrait;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'provinces';

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }

    public function uangHarian()
    {
        return $this->hasOne(UangHarian::class, 'province_id', 'id');
    }

    public function tujuanPerjalanan()
    {
        return $this->hasMany(DataTujuanPerjalanan::class, 'tempat_berangkat_id', 'id');
    }

    public function tujuanPerjalanan2()
    {
        return $this->hasMany(DataTujuanPerjalanan::class, 'tempat_tujuan_id', 'id');
    }

    public function hotel() {
        return $this->hasMany(sbm_hotel::class, 'province_id', 'id');
    }

    public function tiket() {
        return $this->hasMany(sbm_tiket::class, 'province_id', 'id');
    }

    public function translok() {
        return $this->hasMany(sbm_translok::class, 'province_id', 'id');
    }
}
