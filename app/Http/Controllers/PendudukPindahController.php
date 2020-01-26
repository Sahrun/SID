<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PendudukPindah;
use App\Wilayah;
use App\Penduduk;
use DateTime;

class PendudukPindahController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $penduduk_pindah = new PendudukPindah;

        $pages = 0;
        $page = 0;
        $showdata = 10;

        $penduduk_pindah = $penduduk_pindah->newQuery();

        $penduduk_pindah->join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
                       ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name');

        if(isset($request->search))
        {
            $penduduk_pindah->where('penduduk.nik','like',''.$request->search.'%');
            $penduduk_pindah->orWhere('penduduk.full_name', 'like',''.$request->search.'%');
        }

        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;

        }

        if(isset($request->showdata) && !empty($request->showdata))
        {
            $showdata = $request->showdata;

        }

        
        $result  = $penduduk_pindah->get();

        $penduduk_pindah->offset(($page * $showdata));
        $penduduk_pindah->limit($showdata);

        $penduduk_pindah = $penduduk_pindah->get();
         
        $pages =  ceil(count($result) / $showdata);

        return view('pages.kependudukan.penduduk_pindah.index',['penduduk_pindah' => $penduduk_pindah,'pages' => $pages,'page' => $page,'showdata' => $showdata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $penduduk = new Penduduk;

        $pages = 0;
        $page = 0;
        $showdata = 10;

        $penduduk = $penduduk->newQuery();

        $penduduk->where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah");


        if(isset($request->search))
        {
            $penduduk->whereRaw("(nik like '".$request->search."%' OR full_name like '".$request->search."%')");

        }

        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;

        }

        if(isset($request->showdata) && !empty($request->showdata))
        {
            $showdata = $request->showdata;

        }

        $result  = $penduduk->get();

        $penduduk->offset(($page * $showdata));
        $penduduk->limit($showdata);

        $penduduk = $penduduk->get();
         
        $pages =  ceil(count($result) / $showdata);
        
        return view('pages.kependudukan.penduduk_pindah.form',['penduduk'=> $penduduk,'pages' => $pages,'page' => $page,'showdata' => $showdata]);
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

        $penduduk_pindah = new PendudukPindah;
        DB::transaction(function () use ($penduduk,$penduduk_pindah,$request) {
            // Update data penduduk status penduduk = pindah
            $penduduk->status_kependudukan = "Pindah";
            $penduduk->save();

            // Insert ke table penduduk pindah
            $penduduk_pindah->tgl_pindah = $request->tgl_pindah;
            $penduduk_pindah->alasan_pindah = $request->alasan_pindah;
            $penduduk_pindah->alamat_pindah = $request->alamat_pindah;
            $penduduk_pindah->penduduk_id = $request->penduduk_id;
            $penduduk_pindah->created_at = Date("Y-m-d h:i:s");
            $penduduk_pindah->updated_at = Date("Y-m-d h:i:s");
            $penduduk_pindah->save();
        });

        return redirect()->action('PendudukPindahController@index');
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
        $penduduk_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->where('pindah_id',$id)
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name as nama')
        ->first();
        return  $penduduk_pindah;
         
    }

 
    public function update(Request $request, $id)
    {
        $penduduk_pindah = PendudukPindah::find($id);
        $penduduk_pindah->tgl_pindah = $request->tgl_pindah;
        $penduduk_pindah->alamat_pindah = $request->alamat_pindah;
        $penduduk_pindah->alasan_pindah = $request->alasan_pindah;
        $penduduk_pindah->updated_at = Date("Y-m-d h:i:s");
        $penduduk_pindah->save();

        return redirect()->back();
    }
    public function destroy($id)
    {
        $penduduk_pindah = PendudukPindah::find($id);
        $penduduk = new Penduduk;
        DB::transaction(function () use ($penduduk,$penduduk_pindah) {
            $penduduk::where('penduduk_id',$penduduk_pindah->penduduk_id)->update(['status_kependudukan' => "Tetap"]);
            $penduduk_pindah->delete();
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
