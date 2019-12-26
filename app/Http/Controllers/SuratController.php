<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Surat;
use App\Identitas;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $path_folder="master_surat";
    protected $identitas = array();

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function format_surat()
    {
        $surat = new Surat;
        $result =   $surat->format_surat;
        return View("pages.surat.format_surat",['surat' => $result]);
    }
    public function download($file)
    {
        return response()->download(public_path('master_surat/'.$file));
    }
    public function upload(Request $request)
    {
        $surat = new Surat;

		$file = $request->file('file');
        
        $to_folder = 'master_surat';
        $file->move($to_folder,$surat->getnamefile($request->kode));
        return redirect()->back();
    }

    public function daftar_cetak_surat()
    {
        $surat = new Surat;
        $result =   $surat->format_surat;
        return View("pages.surat.daftar_cetak_surat",['surat' => $result]);

    }
    public function Cetak_surat_kematian($kode)
    {
        $surat = new Surat;
        $this->getIdentitalDesaAll();
        $document =  file_get_contents(public_path('master_surat').'\\'.$surat->getnamefile($kode));
 
        $document = str_replace("[SEBUTAN_KABUPATEN]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[NAMA_KAB]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[NAMA_KEC]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[SEBUTAN_DESA]", $this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[NAMA_DES]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[alamat_des]", $this->getIdentitas("alamat_desa"), $document);
        
        
        $document = str_replace("[judul_surat]", $surat->getTitleFile($kode), $document);
        $document = str_replace("[nomor_surat]", "harcode", $document);
        $document = str_replace("[tahun]", Date("Y"), $document);
        
        
        $document = str_replace("[jabatan]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[sebutan_kabupaten]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_provinsi]", $this->getIdentitas("nama_prov"), $document);
        
        
        $document = str_replace("[nama]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[no_ktp]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[sex]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[tempatlahir]",$this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[agama]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[alamat_jalan]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[rt]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[rw]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[dusun]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_prov"), $document);
        
        
        $document = str_replace("[form_hari]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[form_tanggal_mati]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[form_jam]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[form_tempat_mati]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[sebab_nama]", $this->getIdentitas("nama_prov"), $document);
        
        
        $document = str_replace("[nama_pelapor]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nik_pelapor]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[tanggal_lahir_pelapor]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[pekerjaanpelapor]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[alamat_pelapor]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[hubungan_pelapor]", $this->getIdentitas("nama_prov"), $document);
        
        
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[tgl_surat]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[jabatan]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_prov"), $document);
        
        $document = str_replace("[nama_pamong]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[pamong_nip]", $this->getIdentitas("nama_prov"), $document);

        $filename = $surat->getTitleFile($kode).".doc";
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=".$filename);
        header("Content-length: " . strlen($document));
        echo $document;
    }

    public function getIdentitalDesaAll()
    {
        
      $data =  Identitas::all();
      foreach ($data as $key => $val) {
         array_push($this->identitas,array(
            "key"=> $val["identitas_key"],
            "title" => $val["identitas_titel"],
            "value" => $val["identitas_value"]
         ));
      }
    }
    public function getIdentitas($paramkey,$res = "value")
    {

        foreach ($this->identitas as $key => $val) {

            if($val["key"] == $paramkey)
            {
                return  $val[$res];
            }
        }
        return null;

    }
}
