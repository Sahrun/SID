<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Keluarga;
use App\Penduduk;
use App\Wilayah;
use App\Kelahiran;

class KelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelahiran = Kelahiran::leftjoin('penduduk', 'penduduk.penduduk_id','=','kelahiran.penduduk_id')
        ->leftjoin('keluarga', 'penduduk.keluarga_id', '=', 'keluarga.keluarga_id')
        ->get();
        return view('pages.kependudukan.kelahiran.index',['kelahiran' => $kelahiran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dusun =  Wilayah::where('wilayah_part',1)->get();
        $penduduk = Penduduk::all();
        $keluarga = Keluarga::all();
        return view('pages.kependudukan.kelahiran.form',['dusun'=> $dusun,'penduduk' => $penduduk,'keluarga' => $keluarga]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keluarga = Keluarga::find($request->keluarga_id);
        $penduduk = new Penduduk;
        $kelahiran = new Kelahiran;
       
       DB::transaction(function () use ($penduduk,$kelahiran,$request,$keluarga) {
           
            // Insert To Table Penduduk
            $penduduk->nik = $request->nik;
            $penduduk->full_name = $request->full_name;
            $penduduk->no_kk = $keluarga->no_kk;
            $penduduk->tempat_lahir = $request->tempat_lahir;
            $penduduk->tanggal_lahir = $request->tanggal_lahir;
            $penduduk->jekel = $request->jekel;
            $penduduk->agama = $request->agama;
            $penduduk->pendidikan = null;
            $penduduk->pekerjaan = null;
            $penduduk->status_perkawinan = null;
            $penduduk->golongan_darah = $request->golongan_darah;
            $penduduk->status_kependudukan = null;
            $penduduk->keluarga_id = $request->keluarga_id;
            $penduduk->hubungan_keluarga = "ANAK";
            $penduduk->wilayah_dusun = $request->wilayah_dusun;
            $penduduk->wilayah_rw = $request->wilayah_rw;
            $penduduk->wilayah_rt = $request->wilayah_rt;
            $penduduk->alamat = $request->alamat;
            $penduduk->created_at = Date("Y-m-d h:i:s");
            $penduduk->updated_at = Date("Y-m-d h:i:s");
            $penduduk->save();
            // Insert To table Kelahiran
            $kelahiran->penduduk_id = $penduduk->penduduk_id;
            $kelahiran->id_penduduk_ibu = $request->id_penduduk_ibu;
            $kelahiran->id_penduduk_ayah = $request->id_penduduk_ayah;
            $kelahiran->tob = $request->tob;
            $kelahiran->hob = $request->hob;
            $kelahiran->kondisi_lahir = $request->kondisi_lahir;
            $kelahiran->berat = $request->berat;
            $kelahiran->panjang = $request->panjang;
            $kelahiran->anak_ke = $request->anak_ke;
            $kelahiran->jenis_kelahiran = $request->jenis_kelahiran;
            $kelahiran->created_at = Date("Y-m-d h:i:s");
            $kelahiran->updated_at = Date("Y-m-d h:i:s");
            $kelahiran->save();
        });
        return redirect()->action('KelahiranController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelahiran =  kelahiran::join('penduduk','penduduk.penduduk_id','=','kelahiran.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->leftjoin('penduduk as ibu','ibu.penduduk_id','=','kelahiran.id_penduduk_ibu')
        ->leftjoin('penduduk as ayah','ibu.penduduk_id','=','kelahiran.id_penduduk_ayah')
        ->select('penduduk.*','kelahiran.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT','ibu.nik as nik_ibu','ayah.nik as nik_ayah')
        ->where('kelahiran.kelahiran_id',$id)->first();
        return view('pages.kependudukan.kelahiran.view',['kelahiran' => $kelahiran ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelahiran = kelahiran::join('penduduk', 'penduduk.penduduk_id', '=', 'kelahiran.penduduk_id')
        ->where('kelahiran_id',$id)
        ->select('kelahiran.*','penduduk.*')
        ->first();
        $dusun = Wilayah::where('wilayah_part',1)->get();
        $rw =  Wilayah::where('wilayah_part',2)->where('wilayah_dusun',$kelahiran->wilayah_dusun)->get();
        $rt = Wilayah::where('wilayah_part',3)->where('wilayah_rw',$kelahiran->wilayah_rw)->get();
        return view('pages.kependudukan.kelahiran.edit',['kelahiran'=> $kelahiran, 'dusun' => $dusun,'rw' => $rw,'rt' => $rt]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelahiran = Kelahiran::find($id);
        $penduduk = Penduduk::find($kelahiran->penduduk_id);
        
        DB::transaction(function () use ($penduduk,$kelahiran,$request) {
            $penduduk->nik  = $request->nik;
            $penduduk->wilayah_dusun   = $request->wilayah_dusun;
            $penduduk->wilayah_rw   = $request->wilayah_rw;
            $penduduk->wilayah_rt   = $request->wilayah_rt;
            $penduduk->full_name   = $request->full_name;
            $penduduk->tempat_lahir   = $request->tempat_lahir;
            $penduduk->tanggal_lahir   = $request->tanggal_lahir;
            $penduduk->jekel   = $request->jekel;
            $penduduk->agama   = $request->agama;
            $penduduk->pendidikan   = $request->pendidikan;
            $penduduk->pekerjaan   = $request->pekerjaan;
            $penduduk->status_perkawinan   = $request->status_perkawinan;
            $penduduk->golongan_darah   = $request->golongan_darah;
            $penduduk->status_kependudukan   = $request->status_kependudukan;
            $penduduk->alamat = $request->alamat;
            $penduduk->updated_at    = Date("Y-m-d h:i:s");
            $penduduk->save();

            $kelahiran->tob             = $request->tob;
            $kelahiran->hob             = $request->hob;
            $kelahiran->kondisi_lahir   = $request->kondisi_lahir;
            $kelahiran->anak_ke         = $request->anak_ke;
            $kelahiran->berat           = $request->berat;
            $kelahiran->panjang         = $request->panjang;
            $kelahiran->jenis_kelahiran = $request->jenis_kelahiran;
            $kelahiran->updated_at      = Date("Y-m-d h:i:s");
            $kelahiran->save();
        });
         return redirect()->action('KelahiranController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelahiran = Kelahiran::find($id);
        $penduduk = new Penduduk;
        DB::transaction(function () use ($penduduk,$kelahiran) {
            $kelahiran->delete();
            $penduduk->deletePendudukWithRelasion($kelahiran->penduduk_id);
        });
        return redirect()->back();
    }
}
