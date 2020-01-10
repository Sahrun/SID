<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Penduduk;
use App\Wilayah;
use App\Keluarga;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $part = array(
        "dusun" => "1",
        "rw" => "2",
        "rt" => "3"
    );

    public function index()
    {
       $wilayah = Wilayah::leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                            ->where('wilayah_part', $this->part['dusun'])
                            ->get();
       return view('pages.kependudukan.wilayah.index',['wilayah'=>$wilayah]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penduduk =  Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
        return view('pages.kependudukan.wilayah.form',["penduduk"=>$penduduk]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dusun = New Wilayah;
        $id_dusun = null;
        // Input Dusun

        
        $dusun->wilayah_part  = $this->part['dusun'];
        $dusun->wilayah_dusun = NULL;
        $dusun->wilayah_rw    = NULL;
        $dusun->wilayah_rt    = NULL;
        $dusun->wilayah_nama  = $request->wilayah_nama;
        $dusun->penduduk_id   = $request->penduduk_id;
        $dusun->created_at    = Date("Y-m-d h:i:s");
        $dusun->updated_at    = Date("Y-m-d h:i:s");
        
        
        // Input RW
        if($dusun->save()){
            $rw  = New Wilayah;
            $id_dusun = $dusun->wilayah_id;
            $id_rw= null;
                $rw->wilayah_part    = $this->part['rw'];
                $rw->wilayah_dusun   = $id_dusun;
                $rw->wilayah_rw      = NULL;
                $rw->wilayah_rt      = NULL;
                $rw->wilayah_nama    = "-";
                $rw->penduduk_id     = NULL;
                $rw->created_at      = Date("Y-m-d h:i:s");
                $rw->updated_at      = Date("Y-m-d h:i:s");

                // Input RT
                if($rw->save()){
                    $rt  = New Wilayah;
                    $id_rw = $rw->wilayah_id;
                    $rt->wilayah_part    = $this->part['rt'];
                    $rt->wilayah_dusun   = $id_dusun;
                    $rt->wilayah_rw      = $id_rw;
                    $rt->wilayah_rt      = NULL;
                    $rt->wilayah_nama    = "-";
                    $rt->penduduk_id     = NULL;
                    $rt->created_at      = Date("Y-m-d h:i:s");
                    $rt->updated_at      = Date("Y-m-d h:i:s");

                    $rt->save();
                }
        }
        
        return redirect()->action('WilayahController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wilayah = new Wilayah;
        $dusun =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
        ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama')
        ->where('wilayah.wilayah_id',$id)->first();

        $rw =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
        ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama','penduduk.full_name')
        ->where('wilayah.wilayah_part',$this->part['rw'])
        ->where('wilayah.wilayah_dusun',$id) 
        ->orderBy('wilayah_id', 'asc')->get();

        return view('pages.kependudukan.wilayah.view',['dusun' =>  $dusun,'rw'=>$rw]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penduduk =  Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
        $wilayah =  DB::table('wilayah')->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
        ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama')
        ->where('wilayah.wilayah_id',$id)->first();
        return view('pages.kependudukan.wilayah.edit',['wilayah' =>  $wilayah,"penduduk"=>$penduduk]);
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
        $dusun = Wilayah::find($id);
        $dusun->wilayah_nama  = $request->wilayah_nama;
        $dusun->penduduk_id   = $request->penduduk_id;
        $dusun->updated_at    = Date("Y-m-d h:i:s");
        $dusun->save();
        return redirect()->action('WilayahController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wilayah = Wilayah::find($id);
        DB::transaction(function () use ($wilayah) {
         if($wilayah->wilayah_part == $this->part['dusun'])
         {
            $this->delete_dusun($wilayah);
         }
         else if($wilayah->wilayah_part == $this->part['rw'])
         {
            $this->delete_rw($wilayah);
         }
         else if($wilayah->wilayah_part == $this->part['rt'])
         {
            $this->delete_rt($wilayah);
         }
        });
        return redirect()->back();
    }

    public function delete_rw($rw){
        $wilayah = new Wilayah;

        $rt = $wilayah->where('wilayah_part','=',$this->part['rt'])
        ->where('wilayah_rw','=',$rw->wilayah_id)->get();
        foreach($rt as $key => $value){
            $this->delete_rt($value);
        }
        Penduduk::where('wilayah_rw',$rw->wilayah_id)->update(['wilayah_rw' => null]);
        Keluarga::where('wilayah_rw',$rw->wilayah_id)->update(['wilayah_rw' => null]);
        $rw->delete();
    }
    public function delete_rt($rt)
    {
        Penduduk::where('wilayah_rt',$rt->wilayah_id)->update(['wilayah_rt' => null]);
        Keluarga::where('wilayah_rt',$rt->wilayah_id)->update(['wilayah_rt' => null]);
        $rt->delete();
    }
    public function delete_dusun($dusun)
    {
        $wilayah = new Wilayah;

        $rw = $wilayah->where('wilayah_part','=',$this->part['rw'])
        ->where('wilayah_dusun','=',$dusun->wilayah_id)->get();
        foreach($rw as $key => $value){
            $this->delete_rw($value);
        }
        Penduduk::where('wilayah_dusun',$dusun->wilayah_id)->update(['wilayah_dusun' => null]);
        Keluarga::where('wilayah_dusun',$dusun->wilayah_id)->update(['wilayah_dusun' => null]);
        $dusun->delete();

    }
    
    public function add_rw($id)
    {

        $dusun = Wilayah::find($id);
        $penduduk =  Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
        return view('pages.kependudukan.wilayah.form-rw',['dusun' =>  $dusun,"penduduk"=>$penduduk]);
    }

    public function create_rw(Request $request,$id)
    {

            // Input RW

            $rw  = New Wilayah;
            $id_rw= null;
                $rw->wilayah_part    = $this->part['rw'];
                $rw->wilayah_dusun   = $id;
                $rw->wilayah_rw      = NULL;
                $rw->wilayah_rt      = NULL;
                $rw->wilayah_nama    = $request->wilayah_nama;
                $rw->penduduk_id     = $request->penduduk_id;
                $rw->created_at      = Date("Y-m-d h:i:s");
                $rw->updated_at      = Date("Y-m-d h:i:s");

                // Input RT
                if($rw->save()){
                    $rt  = New Wilayah;
                    $id_rw = $rw->wilayah_id;
                    $rt->wilayah_part    = $this->part['rt'];
                    $rt->wilayah_dusun   = $id;
                    $rt->wilayah_rw      = $id_rw;
                    $rt->wilayah_rt      = NULL;
                    $rt->wilayah_nama    = "-";
                    $rt->penduduk_id     = NULL;
                    $rt->created_at      = Date("Y-m-d h:i:s");
                    $rt->updated_at      = Date("Y-m-d h:i:s");

                    $rt->save();
            
                    return redirect('kependudukan/wilayah/view/'.$id);
                }
    }

    public function show_rw($id)
    {
        $wilayah = new Wilayah;
        $rw =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_dusun','wilayah.wilayah_nama','penduduk.full_name')
                ->where('wilayah.wilayah_id',$id)->first();

        $dusun =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama')
                ->where('wilayah.wilayah_id',$rw->wilayah_dusun)->first();

        $rt =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama','penduduk.full_name')
                ->where('wilayah.wilayah_part',$this->part['rt'])
                ->where('wilayah.wilayah_rw',$id) 
                ->orderBy('wilayah.wilayah_id', 'asc')->get();

       return view('pages.kependudukan.wilayah.view-rw',['dusun' =>  $dusun,'rw'=>$rw,'rt' =>$rt]);
    }

    public function edit_rw($id)
    {
        $wilayah = new Wilayah;

        $penduduk =  Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();

        $rw =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_dusun','wilayah.wilayah_nama','penduduk.full_name')
                ->where('wilayah.wilayah_id',$id)->first();

        $dusun =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama')
                ->where('wilayah.wilayah_id',$rw->wilayah_dusun)->first();

       return view('pages.kependudukan.wilayah.edit-rw',['dusun' =>  $dusun,'rw'=>$rw,'penduduk'=>$penduduk]);
    }

    public function update_rw(Request $request, $id)
    {
        $rw = Wilayah::find($id);
        $rw->wilayah_nama  = $request->wilayah_nama;
        $rw->penduduk_id   = $request->penduduk_id;
        $rw->updated_at    = Date("Y-m-d h:i:s");
        $rw->save();
        return redirect('kependudukan/wilayah/view/'.$rw->wilayah_dusun);
    }

    public function add_rt($id)
    {
        $rw = Wilayah::find($id);
        $penduduk =  Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
        return view('pages.kependudukan.wilayah.form-rt',['rw' =>  $rw,"penduduk"=>$penduduk]);
    }
    public function create_rt(Request $request,$id)
    {
           $rw = Wilayah::find($id);

                $rt  = New Wilayah;
                $rt->wilayah_part    = $this->part['rt'];
                $rt->wilayah_dusun   = $rw->wilayah_dusun;
                $rt->wilayah_rw      = $id;
                $rt->wilayah_rt      = NULL;
                $rt->wilayah_nama    = $request->wilayah_nama;
                $rt->penduduk_id     = NULL;
                $rt->created_at      = Date("Y-m-d h:i:s");
                $rt->updated_at      = Date("Y-m-d h:i:s");

                $rt->save();
            
            return redirect('kependudukan/wilayah/view-rw/'.$id);
    }

    public function edit_rt($id)
    {
        $wilayah = new Wilayah;

        $penduduk =  Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();

        $rt=  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_rw','wilayah.wilayah_nama','penduduk.full_name')
                ->where('wilayah.wilayah_id',$id)->first();

        $rw =  $wilayah->leftjoin('penduduk', 'wilayah.penduduk_id', '=', 'penduduk.penduduk_id')
                ->select('wilayah.wilayah_id', 'penduduk.penduduk_id','wilayah.wilayah_nama')
                ->where('wilayah.wilayah_id',$rt->wilayah_rw)->first();

       return view('pages.kependudukan.wilayah.edit-rt',['rw' =>  $rw,'rt'=>$rt,'penduduk'=>$penduduk]);
    }

    public function update_rt(Request $request, $id)
    {
        $rt = Wilayah::find($id);
        $rt->wilayah_nama  = $request->wilayah_nama;
        $rt->penduduk_id   = $request->penduduk_id;
        $rt->updated_at    = Date("Y-m-d h:i:s");
        $rt->save();
        return redirect('kependudukan/wilayah/view-rw/'.$rt->wilayah_rw);
    }
}
