<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendatang extends Model
{
    //
    protected $table = 'pendatang';
    protected $primaryKey ='pendatang_id';
    protected $timestam = true;
    Protected $fillable = [
            "tgl_datang",
            "alamat_datang",
            "alasan_datang",
            "penduduk_id",
            "created_at",
            "updated_at"
    ];
}
