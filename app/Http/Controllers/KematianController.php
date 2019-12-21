<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $penduduk = Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
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
        $penduduk = Penduduk::find($request->penduduk_id);

        $kematian = new Kematian;
        DB::transaction(function () use ($penduduk,$kematian,$request) {
            // Update data penduduk status penduduk = meninggal
            $penduduk->status_kependudukan = "Meninggal";
            $penduduk->save();

            // Insert ke table kematian
            $kematian->tgl_kematian = $request->tgl_kematian;
            $kematian->jam_kematian = $request->jam_kematian;
            $kematian->tempat_kematian = $request->tempat_kematian;
            $kematian->sebab_kematian = $request->sebab_kematian;
            $kematian->penduduk_id = $request->penduduk_id;
            $kematian->created_at = Date("Y-m-d h:i:s");
            $kematian->updated_at = Date("Y-m-d h:i:s");
            $kematian->save();
        });

        return redirect()->action('KematianController@index');
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
            $kematian = Kematian::join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
            ->where('kematian_id',$id)
            ->select('kematian.*','penduduk.nik','penduduk.full_name as nama')
            ->first();
            return  $kematian;
         
        }

 
    public function update(Request $request, $id)
    {
        $kematian = Kematian::find($id);
        $kematian->tgl_kematian = $request->tgl_kematian;
        $kematian->jam_kematian = $request->jam_kematian;
        $kematian->tempat_kematian = $request->tempat_kematian;
        $kematian->sebab_kematian = $request->sebab_kematian;
        $kematian->updated_at = Date("Y-m-d h:i:s");
        $kematian->save();

        return redirect()->back();
    }
    public function destroy($id)
    {
        $kematian = Kematian::find($id);
        $penduduk = new Penduduk;
        DB::transaction(function () use ($penduduk,$kematian) {
            $penduduk::where('penduduk_id',$kematian->penduduk_id)->update(['status_kependudukan' => "Tetap"]);
            $kematian->delete();
        });
        return redirect()->back();
        
    }
    public function get_data_penduduk($id)
    {
        $penduduk = Penduduk::find($id);
        $result = array(
            "penduduk_id" => $penduduk->penduduk_id,
            "nik" => $penduduk->nik,
            "nama" => $penduduk->full_name,
            "usia" => date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y
        );
        return $result;
    }
}
