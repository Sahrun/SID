<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    //
    protected $table = 'kematian';
    protected $primaryKey ='kematian_id';
    protected $timestam = true;
    Protected $fillable = [
            "tgl_kematian",
            "jam_kematian",
            "tempat_kematian",
            "sebab_kematian",
            "penduduk_id",
            "created_at",
            "updated_at"
            ];
}
