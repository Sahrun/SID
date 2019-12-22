<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    protected $table = 'kelahiran';
    protected $primaryKey ='kelahiran_id';
    protected $timestam = true;
    Protected $fillable = [
        "penduduk_id",
        "id_penduduk_ibu",
        "id_penduduk_ayah",
        "tob",
        "hob",
        "kondisi_lahir",
        "berat",
        "panjang",
        "anak_ke",
        "jenis_kelahiran",
        "created_at",
        "updated_at"
    ];

}
