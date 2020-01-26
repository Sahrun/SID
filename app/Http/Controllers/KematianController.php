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
    public function index(Request $request)
    {

        $kematian = new Kematian;

        $pages = 0;
        $page = 0;
        $showdata = 10;

        $kematian = $kematian->newQuery();

        $kematian->join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
                 ->select('kematian.*','penduduk.nik','penduduk.full_name');

        if(isset($request->search))
        {
            $kematian->where('penduduk.nik','like',''.$request->search.'%');
            $kematian->orWhere('penduduk.full_name', 'like',''.$request->search.'%');
        }

        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;

        }

        if(isset($request->showdata) && !empty($request->showdata))
        {
            $showdata = $request->showdata;

        }

        
        $result  = $kematian->get();

        $kematian->offset(($page * $showdata));
        $kematian->limit($showdata);

        $kematian = $kematian->get();
         
        $pages =  ceil(count($result) / $showdata);
    
        return view('pages.kependudukan.kematian.index',['kematian' => $kematian,'pages' => $pages,'page' => $page,'showdata' => $showdata]);
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
            $penduduk->where('nik','like',''.$request->search.'%');
            $penduduk->orWhere('full_name', 'like',''.$request->search.'%');
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
    
        return view('pages.kependudukan.kematian.form',['penduduk' => $penduduk,'pages' => $pages,'page' => $page,'showdata' => $showdata]);

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
