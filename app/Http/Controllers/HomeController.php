<?php

namespace App\Http\Controllers;

use App\Penduduk;
use App\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dusun = Wilayah::where('wilayah_part', (new Wilayah)->part["dusun"])->select(DB::raw('count(distinct(wilayah_id)) as jml_dusun'))
        ->get();

        $rt = Wilayah::where('wilayah_part', (new Wilayah)->part["rt"])->select(DB::raw('count(distinct(wilayah_id)) as jml_rt'))
        ->get();

        $rw = Wilayah::where('wilayah_part', (new Wilayah)->part["rw"])->select(DB::raw('count(distinct(wilayah_id)) as jml_rw'))
        ->get();
        
        $penduduk = Penduduk::select(DB::raw('count(*) as jml_penduduk'))
        ->where([
            ['status_kependudukan', '<>', 'Meninggal'],
            ['status_kependudukan', '<>', 'Pindah']
        ])
        ->orWhereNull('status_kependudukan')
        ->get();

        $pendudukDusun = Wilayah::leftjoin(DB::raw("(select * from penduduk where status_kependudukan  != 'Meninggal' and status_kependudukan != 'Pindah') as penduduk"), function( $join )
                        {
                            $join->on( 'penduduk.wilayah_dusun', '=', 'wilayah.wilayah_id' );
                        })
        ->select('wilayah.wilayah_nama as DUSUN', DB::raw('count(penduduk.penduduk_id) as jml_penduduk'))
        ->where('wilayah_part','=',(new Wilayah)->part["dusun"])
        ->groupBy('DUSUN')
        ->get();

        $jen_kel = Penduduk::select(DB::raw('ifnull(jekel, "Belum isi data") as jekel, count(*) as jumlah'))
        ->where([
            ['status_kependudukan', '<>', 'Meninggal'],
            ['status_kependudukan', '<>', 'Pindah']
        ])
        ->groupBy('jekel')
        ->get();

        $agama = Penduduk::select(DB::raw('ifnull(agama, "Belum isi data") as agama, count(*) as jumlah'))
        ->where([
            ['status_kependudukan', '<>', 'Meninggal'],
            ['status_kependudukan', '<>', 'Pindah']
        ])
        ->groupBy('agama')
        ->get();

        return view('pages.home.home', ['dusun' => $dusun, 'rt' => $rt, 'rw' => $rw, 'penduduk' => $penduduk,
            'penduduk_dusun' => $pendudukDusun, 'jen_kel' => $jen_kel, 'agama' => $agama]);
    }
}
