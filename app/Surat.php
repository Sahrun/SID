<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $primaryKey ='surat_id';
    protected $timestam = true;
    Protected $fillable = [
                "nama_surat",
                "tanggal",
                "hal",
                "surat_filename",
                "penduduk_id",
                "staff_id",
                "created_at",
                "updated_at"
    ];

    public $master_surat = array(
            array(
                "kode" => "S01",
                "title" => "Surat Keterangan Kelahiran",
                "template" => ""
            ),
            array(
                "kode" => "S02",
                "title" => "Surat Keterangan Kematian",
                "template" => ""
            ),
            array(
                "kode" => "S03",
                "title" => "Surat Keterangan Kurang Mampu",
                "template" => ""
            ),
            array(
                "kode" => "S04",
                "title" => "Surat Pengantar ",
                "template" => ""
            ),
            array(
                "kode" => "S05",
                "title" => "Surat Keterangan Pindah Penduduk",
                "template" => ""
            )
    );
}
