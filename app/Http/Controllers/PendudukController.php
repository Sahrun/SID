<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wilayah;
use Illuminate\Support\Facades\DB;
use App\Penduduk;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendudukExport;
use App\Exports\PemilihTetapExport;


class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penduduk = new Penduduk;

        $pages = 0;
        $page = 0;
        $showdata = 10;

        $penduduk = $penduduk->newQuery();

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

        $penduduk->leftjoin('keluarga', 'keluarga.kepala_keluarga', '=', 'penduduk.penduduk_id');

        $penduduk->where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
        
        $penduduk->select('penduduk.*', 'keluarga.kepala_keluarga');

        if(isset($request->order) && !empty($request->order))
        {
            if($request->order == "desc")
            {
                $penduduk->orderBy('full_name', 'desc');
            }else
            {
                $penduduk->orderBy('full_name', 'asc');
            }
        }else
        {
            $penduduk->orderBy('full_name', 'asc');
        }
        
        $result  = $penduduk->get();

        $penduduk->offset(($page * $showdata));
        $penduduk->limit($showdata);

        $penduduk = $penduduk->get();
         
        $pages =  ceil(count($result) / $showdata);
      
       return view('pages.kependudukan.penduduk.index',['penduduk' => $penduduk,'pages' => $pages,'page' => $page,'showdata' => $showdata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dusun =  Wilayah::where('wilayah_part',1)->get();
        return view('pages.kependudukan.penduduk.form',['dusun'=> $dusun]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Penduduk::create([ 
        "nik" => $request->nik,
        "full_name" => $request->full_name,
        "tempat_lahir" => $request->tempat_lahir,
        "tanggal_lahir" => $request->tanggal_lahir,
        "jekel" => $request->jekel,
        "agama" => $request->agama,
        "pendidikan" => $request->pendidikan,
        "pekerjaan" => $request->pekerjaan,
        "status_perkawinan" => $request->status_perkawinan,
        "golongan_darah" => $request->golongan_darah,
        "status_kependudukan" => $request->status_kependudukan,
        "keluarga_id" => null,
        "hubungan_keluarga" => null,
        "wilayah_dusun" => $request->wilayah_dusun,
        "wilayah_rw" => $request->wilayah_rw,
        "wilayah_rt" => $request->wilayah_rt,
        "alamat" => $request->alamat,
        "ktp_elektronik" => $request->ktp_elektronik,
        "no_akta_kelahiran" => $request->no_akta_kelahiran,
        "status_warganegara" => $request->status_warganegara,
        "no_paspor" => $request->no_paspor,
        "no_kitas_kitap" => $request->no_kitas_kitap,
        "nama_ayah" => $request->nama_ayah,
        "nama_ibu" => $request->nama_ibu,
        "created_at" => Date("Y-m-d h:i:s"),
        "updated_at" => Date("Y-m-d h:i:s")
        ]);

        return redirect()->action('PendudukController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penduduk =  Penduduk::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->leftjoin('keluarga', 'keluarga.keluarga_id', '=', 'penduduk.keluarga_id')
        ->select('penduduk.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT','keluarga.no_kk as no_kk')
        ->where('penduduk.penduduk_id',$id)->first();
       return view('pages.kependudukan.penduduk.view',['penduduk' => $penduduk ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
        {
            $penduduk = Penduduk::find($id);
            $dusun = Wilayah::where('wilayah_part',1)->get();
            $rw =  Wilayah::where('wilayah_part',2)->where('wilayah_dusun',$penduduk->wilayah_dusun)->get();
            $rt = Wilayah::where('wilayah_part',3)->where('wilayah_rw',$penduduk->wilayah_rw)->get();

            return view('pages.kependudukan.penduduk.edit',['penduduk' => $penduduk, 'dusun' => $dusun,'rw' => $rw,'rt' => $rt]);
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
        $penduduk = Penduduk::find($id);
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
        $penduduk->ktp_elektronik = $request->ktp_elektronik;
        $penduduk->no_akta_kelahiran = $request->no_akta_kelahiran;
        $penduduk->status_warganegara = $request->status_warganegara;
        $penduduk->no_paspor = $request->no_paspor;
        $penduduk->no_kitas_kitap = $request->no_kitas_kitap;
        $penduduk->nama_ayah = $request->nama_ayah;
        $penduduk->nama_ibu = $request->nama_ibu;
        $penduduk->updated_at    = Date("Y-m-d h:i:s");
        $penduduk->save();
        return redirect()->action('PendudukController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penduduk = new Penduduk;
        DB::transaction(function () use ($penduduk,$id) {
            $penduduk->deletePendudukWithRelasion($id);
        });
        return redirect()->back();
    }
    public function get_wilayah($id,$part)
    {
        $dusun = array();
        if($part =="rw")
        {
            $dusun = Wilayah::where('wilayah_dusun',$id)
            ->where('wilayah_part',2)->get();
        }

        if($part =="rt")
        {
            $dusun = Wilayah::where('wilayah_rw',$id)
            ->where('wilayah_part',3)->get();
        }
         
       return $dusun;
    }
    public function validation_nik($nik,$id)
    {

        $penduduk = new Penduduk;
        $penduduk = $penduduk->newQuery();

        $is_exis = false;

        $penduduk = Penduduk::where('nik','=',$nik);

        if($id !== "null")
        {
           
            $penduduk->where('penduduk_id','!=',$id);
        }
    
        $res = $penduduk->first();

        if($res !== null)
        {
            $is_exis = true;
        }
        
        return array('response' => $is_exis);
    }

    public function excel_penduduk()
    {
        return Excel::download(new PendudukExport, 'penduduk_'.date("YmdHis").'.xlsx');
    }

    public function pemilih_tetap(Request $request)
    {
        
        $pemilih = new Penduduk;
        $pemilih = $pemilih->newQuery();

        $tanggal = null;

        $pages = 0;
        $page = 0;
        $showdata = 10;

        $date = Date("Y-m-d");

        if(isset($request->tanggal))
        {
            $date = $request->tanggal;
            $tanggal = $request->tanggal;
        }

        $pemilih->select(DB::raw("* ,TIMESTAMPDIFF(YEAR, tanggal_lahir, '".$date."') as usia"));

        if(isset($request->search))
        {
            $pemilih->where('penduduk.nik','like',''.$request->search.'%');
            $pemilih->orWhere('penduduk.full_name', 'like',''.$request->search.'%');
        }

        $pemilih->whereRaw("TIMESTAMPDIFF(YEAR, tanggal_lahir, '".$date."') >= 17
        AND ((status_kependudukan != 'Meninggal' AND status_kependudukan != 'Pindah') OR status_kependudukan IS NULL)");



        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;

        }

        if(isset($request->showdata))
        {
            $showdata = $request->showdata;

        }

        $result  = $pemilih->get();
        
        if($showdata !== "0")
        {
            $pemilih->offset(($page * $showdata));
            $pemilih->limit($showdata);
        }

        $pemilih = $pemilih->get();

        if($showdata !== "0")
        {
            $pages =  ceil(count($result) / $showdata);
        }

        return view('pages.kependudukan.penduduk.pemilih_tetap',['pemilih' => $pemilih,'tanggal' => $tanggal,'pages' => $pages,'page' => $page,'showdata' => $showdata]);
    }

    public function pemilih_tetap_export(Request $request)
    {

        $pemilih = new Penduduk;
        $pemilih = $pemilih->newQuery();

        $tanggal = null;

        $pages = 0;
        $page = 0;
        $showdata = 10;

        $date = Date("Y-m-d");

        if(isset($request->tanggal))
        {
            $date = $request->tanggal;
            $tanggal = $request->tanggal;
        }

        $pemilih->leftjoin('keluarga', 'keluarga.keluarga_id', '=', 'penduduk.keluarga_id');
        $pemilih->leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun');
        $pemilih->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw');
        $pemilih->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt');
        $pemilih->select(DB::raw("* ,TIMESTAMPDIFF(YEAR, tanggal_lahir, '".$date."') as usia,keluarga.no_kk as no_kk,dusun.wilayah_nama as dusun,rw.wilayah_nama as rw,rt.wilayah_nama as rt"));

        if(isset($request->search))
        {
            $pemilih->where('penduduk.nik','like',''.$request->search.'%');
            $pemilih->orWhere('penduduk.full_name', 'like',''.$request->search.'%');
        }

        $pemilih->whereRaw("TIMESTAMPDIFF(YEAR, tanggal_lahir, '".$date."') >= 17
        AND ((status_kependudukan != 'Meninggal' AND status_kependudukan != 'Pindah') OR status_kependudukan IS NULL)");



        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;

        }

        if(isset($request->showdata))
        {
            $showdata = $request->showdata;

        }
        
        if($showdata !== "0")
        {
            $pemilih->offset(($page * $showdata));
            $pemilih->limit($showdata);
        }

        $pemilih = $pemilih->get();

        return Excel::download(new PemilihTetapExport($pemilih),'daftar_pemilih_tetap_'.date("YmdHis").'.xlsx');
    }
}
