<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    protected $table = 'kelahiran';
    protected $primaryKey ='kelahiran_id';
    protected $timestam = true;
    Protected $fillable = [
        "nama_anak",
        "nik_ibu",
        "nik_ayah",
        "dob",
        "pob",
        "tob",
        "hob",
        "kondisi_lahir",
        "berat",
        "tinggi",
        "keluarga_id",
        "created_at",
        "updated_at"
    ];

}
