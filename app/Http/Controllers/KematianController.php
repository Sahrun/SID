<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penduduk;
use App\Kematian;
use DateTime;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kematian = Kematian::join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
        ->select('kematian.*','penduduk.nik','penduduk.full_name')
        ->get();
        return view('pages.kependudukan.kematian.index',['kematian' => $kematian]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penduduk = Penduduk::where('status_kependudukan','!=',"Mati")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
         return view('pages.kependudukan.kematian.form',['penduduk'=> $penduduk]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Penduduk::create([ 
        // "nik" => $request->nik,
        // "full_name" => $request->full_name,
        // "no_kk" => $request->no_kk,
        // "tempat_lahir" => $request->tempat_lahir,
        // "tanggal_lahir" => $request->tanggal_lahir,
        // "jekel" => $request->jekel,
        // "agama" => $request->agama,
        // "pendidikan" => $request->pendidikan,
        // "pekerjaan" => $request->pekerjaan,
        // "status_perkawinan" => $request->status_perkawinan,
        // "golongan_darah" => $request->golongan_darah,
        // "status_kependudukan" => $request->status_kependudukan,
        // "keluarga_id" => null,
        // "hubungan_keluarga" => null,
        // "wilayah_dusun" => $request->wilayah_dusun,
        // "wilayah_rw" => $request->wilayah_rw,
        // "wilayah_rt" => $request->wilayah_rt,
        // "created_at" => Date("Y-m-d h:i:s"),
        // "updated_at" => Date("Y-m-d h:i:s")
        // ]);

        // return redirect()->action('PendudukController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
        {
         
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
        
    }

}
