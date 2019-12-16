<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluarga';
    protected $primaryKey ='keluarga_id';
    protected $timestam = true;
    Protected $fillable = [
        "kepala_keluarga",
        "no_kk",
        "wilayah_dusun",
        "wilayah_rw",
        "wilayah_rt",
        "alamat_keluarga",
        "created_at",
        "updated_at"
    ];

    public $hubungan_keluarga = [
        "kepala_keluarga" => "KEPALA KELUARGA",
        "suami" => "SUAMI",
        "istri" => "ISTRI",
        "anak" => "ANAK",
        "menantu" => "MENANTU",
        "cucu" => "CUCU",
        "orangtua" => "ORANGTUA",
        "mertua" => "MERTUA",
        "famili_lain" => "FAMILI LAIN",
        "pembantu" => "PEMBANTU",
        "lainya" => "LAINNYA"
    ];
}
