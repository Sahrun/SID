<?php

namespace App;

use App\Wilayah;
use App\Kelahiran;
use App\Keluarga;
use App\Kematian;
use App\Pendatang;
use App\PendudukPindah;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    //
    protected $table = 'penduduk';
    protected $primaryKey ='penduduk_id';
    protected $timestam = true;
    Protected $fillable = [
                "nik",
                "full_name",
                "tempat_lahir",
                "tanggal_lahir",
                "jekel",
                "agama",
                "pendidikan",
                "pekerjaan",
                "status_perkawinan",
                "golongan_darah",
                "status_kependudukan",
                "keluarga_id",
                "wilayah_dusun",
                "wilayah_rt",
                "wilayah_rw",
                "hubungan_keluarga",
                "alamat",
                "ktp_elektronik",
                "no_akta_kelahiran",
                "status_warganegara",
                "no_paspor",
                "no_kitas_kitap",
                "nama_ayah",
                "nama_ibu",
                "created_at",
                "updated_at",
              ];

  public function deletePendudukWithRelasion($id)
  {
    
        Kelahiran::where('penduduk_id', $id)->delete();
        Wilayah::where('penduduk_id',$id)->update(['penduduk_id' => null]);
        Keluarga::where('keluarga_id',$id)->update(['keluarga_id' => null]);
        Kematian::where('penduduk_id', $id)->delete();
        Pendatang::where('penduduk_id', $id)->delete();
        Pendatang::where('penduduk_id', $id)->delete();
        PendudukPindah::where('penduduk_id', $id)->delete();
        $penduduk = Penduduk::find($id);
        $penduduk->delete();
  }
}
