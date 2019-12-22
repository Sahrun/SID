<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendudukPindah extends Model
{

    protected $table = 'penduduk_pindah';
    protected $primaryKey ='pindah_id';
    protected $timestam = true;
    Protected $fillable = [
              "tgl_pindah",
              "alamat_pindah",
              "alasan_pindah",
              "penduduk_id",
              "created_at",
              "updated_at"
          ];
}
