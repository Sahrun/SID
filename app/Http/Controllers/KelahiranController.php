<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kelahiran;
use App\Keluarga;
use App\Penduduk;
use App\Wilayah;

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
        ->select('kelahiran.*', 'keluarga.no_kk','penduduk.nik','penduduk.tanggal_lahir','penduduk.full_name','penduduk.jekel')->get();
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
            $penduduk->created_at = Date("Y-m-d h:i:s");
            $penduduk->updated_at = Date("Y-m-d h:i:s");
            $penduduk->save();

            // Insert To table Kelahiran
            $kelahiran->penduduk_id = $penduduk->penduduk_id;
            $kelahiran->nik_ibu = $request->nik_ibu;
            $kelahiran->nik_ayah = $request->nik_ayah;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
