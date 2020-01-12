<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Surat;
use App\Identitas;
use App\Kematian;
use App\Staff;
use App\Penduduk;
use App\Kelahiran;
use App\Keluarga;
use App\PendudukPindah;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $path_folder="master_surat";
    protected $identitas = array();
    protected $timezone ="Asia/Jakarta";
    protected $hari = array ( 1 =>    'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
		);
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,$file_name)
    {
        $surat = new Surat;
        
        
        $surat->nama_surat =  $surat->getsuratValue($request->kode_surat,"title");
        $surat->tanggal = Date("Y-m-d");
        $surat->hal = $request->hal;
        $surat->surat_filename = $file_name;
        $surat->penduduk_id = $request->penduduk_id;
        $surat->staff_id = $request->staf_id;
        $surat->created_at = Date("Y-m-d h:i:s");
        $surat->updated_at = Date("Y-m-d h:i:s");
        $surat->save();
        
        return $surat;
    }
    public function destroy($id)
    {
        $surat = Surat::find($id);
        $surat->delete();
        return redirect()->back();
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
    public function form_cetak_surat($kode_surat)
    {
        $surat = new Surat;
  
        $staff = Staff::all();

        if($kode_surat == "S02"){
            $penduduk = Kematian::join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
            ->select('kematian.*','penduduk.nik','penduduk.full_name')
            ->get();
           
            return View($surat->getsuratValue($kode_surat,"page"),['kode_surat' => $kode_surat,'penduduk' => $penduduk,'staff' => $staff]);
        }else if($kode_surat == "S04"){
            $penduduk = Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();
           
            return View($surat->getsuratValue($kode_surat,"page"),['kode_surat' => $kode_surat,'penduduk' => $penduduk,'staff' => $staff]);
        }else if($kode_surat == "S01")
        {
            $penduduk = Kelahiran::join('penduduk', 'penduduk.penduduk_id', '=', 'kelahiran.penduduk_id')
            ->select('kelahiran.*','penduduk.nik','penduduk.full_name')
            ->get();

            $pendudukAll = Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();

            return View($surat->getsuratValue($kode_surat,"page"),['kode_surat' => $kode_surat,'penduduk' => $penduduk,'staff' => $staff,'pendudukAll' => $pendudukAll]);

        }
        else if($kode_surat == "S05")
        {
            $penduduk = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
            ->select('penduduk.*')
            ->get();

            return View($surat->getsuratValue($kode_surat,"page"),['kode_surat' => $kode_surat,'penduduk' => $penduduk,'staff' => $staff]);

        }
        else if($kode_surat == "S03")
        {
            $penduduk = Penduduk::where('status_kependudukan','!=',"Meninggal")->where('status_kependudukan','!=',"Pindah")->orWhereNull('status_kependudukan')->get();

            return View($surat->getsuratValue($kode_surat,"page"),['kode_surat' => $kode_surat,'penduduk' => $penduduk,'staff' => $staff]);

        }
      
    }
    public function cetak_surat_kematian(Request $request)
    {
         $surat = new Surat;
        
         $staff = Staff::find($request->staf_id);

         $penduduk = Penduduk::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
         ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
         ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
         ->select('penduduk.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
         ->where('penduduk.penduduk_id',$request->penduduk_id)->first();

         $kematian = Kematian::where('penduduk_id',$request->penduduk_id)->first();

        $this->getIdentitalDesaAll();
        $document =  file_get_contents(public_path('master_surat').'\\'.$surat->getnamefile($request->kode_surat));
 
        $document = str_replace("[SEBUTAN_KABUPATEN]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[NAMA_KAB]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[NAMA_KEC]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[SEBUTAN_DESA]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[NAMA_DES]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[alamat_des]", $this->getIdentitas("alamat_desa"), $document);
        
        
        $document = str_replace("[judul_surat]", $surat->getTitleFile($request->kode_surat), $document);
        $document = str_replace("[nomor_surat]", $request->nomor_surat, $document);
        $document = str_replace("[tahun]", Date("Y"), $document);
        
        
        $document = str_replace("[jabatan]", $staff->staff_posisi, $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_kabupaten]", $this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[nama_provinsi]", $this->getIdentitas("nama_prov"), $document);
        
        
        $document = str_replace("[nama]", $penduduk->full_name, $document);
        $document = str_replace("[no_ktp]", $penduduk->nik, $document);
        $document = str_replace("[sex]", $penduduk->jekel, $document);
        $document = str_replace("[tempatlahir]",$penduduk->tempat_lahir, $document);
        $document = str_replace("[tanggallahir]",date("d-m-Y",strtotime($penduduk->tanggal_lahir)), $document);
        $document = str_replace("[agama]", $penduduk->agama, $document);
        $document = str_replace("[rt]", $penduduk->RT, $document);
        $document = str_replace("[rw]", $penduduk->RW, $document);
        $document = str_replace("[dusun]", $penduduk->DUSUN, $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_kab"), $document);
        
        
        $document = str_replace("[form_hari]", $this->hari[date("N",strtotime($kematian->tgl_kematian))], $document);
        $document = str_replace("[form_tanggal_mati]", date("d-m-yy",strtotime($kematian->tgl_kematian)), $document);
        $document = str_replace("[form_jam]", $kematian->jam_kematian, $document);
        $document = str_replace("[form_tempat_mati]", $kematian->tempat_kematian, $document);
        $document = str_replace("[sebab_nama]", $kematian->sebab_kematian, $document);
        
        
        $document = str_replace("[nama_pelapor]", $request->nama_pelapor, $document);
        $document = str_replace("[nik_pelapor]", $request->nik_pelapor, $document);
        $document = str_replace("[tanggal_lahir_pelapor]", date("d-m-Y",strtotime($request->tanggal_lahir_pelapor)), $document);
        $document = str_replace("[pekerjaanpelapor]", $request->pekerjaanpelapor, $document);
        $document = str_replace("[alamat_pelapor]", $request->alamat_pelapor, $document);
        $document = str_replace("[hubungan_pelapor]", $request->hubungan_pelapor, $document);
        
        
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[tgl_surat]", Date("d-m-Y"), $document);
        $document = str_replace("[jabatan]", $staff->staff_posisi, $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        
        $document = str_replace("[nama_pamong]", $staff->nama_staff, $document);
        $document = str_replace("[pamong_nip]", $staff->staff_nip, $document);

        $document = str_replace("[kode_desa]", $this->getIdentitas("kode_pos"), $document);
        $document = str_replace("[kode_surat]", $request->nomor_surat, $document);

        $filename = $surat->getTitleFile($request->kode_surat)."_".Date("Ymdhis").".doc";
        $filepath = public_path('data_surat')."\\".$filename;
        
        file_put_contents($filepath, $document);
        
        $result =   $this->save($request,$filename);


        return redirect('surat/get-surat/'.$result->surat_id);
    }
    public function cetak_surat_pengantar(Request $request)
    {
         $surat = new Surat;
        
         $staff = Staff::find($request->staf_id);

         $penduduk = Penduduk::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
         ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
         ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
         ->leftjoin('keluarga','keluarga.keluarga_id','=','penduduk.keluarga_id')
         ->select('penduduk.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT','keluarga.no_kk')
         ->where('penduduk.penduduk_id',$request->penduduk_id)->first();


        $this->getIdentitalDesaAll();
        $document =  file_get_contents(public_path('master_surat').'\\'.$surat->getnamefile($request->kode_surat));
 
        $document = str_replace("[SEBUTAN_KABUPATEN]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[NAMA_KAB]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[NAMA_KEC]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[NAMA_DES]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[alamat_des]", $this->getIdentitas("alamat_desa"), $document);
        
        
        $document = str_replace("[judul_surat]", $surat->getTitleFile($request->kode_surat), $document);
        $document = str_replace("[nomor_surat]", $request->nomor_surat, $document);
        $document = str_replace("[tahun]", Date("Y"), $document);
        
        $document = str_replace("[sebutan_kabupaten]", $this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[nama_provinsi]", $this->getIdentitas("nama_prov"), $document);
        
        
        $document = str_replace("[nama]", $penduduk->full_name, $document);
        $document = str_replace("[tempatlahir]",$penduduk->tempat_lahir, $document);
        $document = str_replace("[tanggallahir]",date("d-m-Y",strtotime($penduduk->tanggal_lahir)), $document);
        $document = str_replace("[usia]",date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[warga_negara]","Indonesia", $document);
        $document = str_replace("[agama]", $penduduk->agama, $document);
        $document = str_replace("[sex]", $penduduk->jekel, $document);
        $document = str_replace("[pekerjaan]", $penduduk->pekerjaan, $document);
        $document = str_replace("[rt]", $penduduk->RT, $document);
        $document = str_replace("[rw]", $penduduk->RW, $document);
        $document = str_replace("[dusun]", $penduduk->DUSUN, $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_kab"), $document);
        
        
        
        
        $document = str_replace("[no_ktp]", $penduduk->nik, $document);
        $document = str_replace("[no_kk]", $penduduk->no_kk, $document);
        $document = str_replace("[keperluan]",$request->hal, $document);
        $document = str_replace("[mulai_berlaku]", date("d-m-Y",strtotime($request->berlaku_mulai)), $document);
        $document = str_replace("[tgl_akhir]", date("d-m-Y",strtotime($request->berlaku_sampai)), $document);
        $document = str_replace("[gol_darah]", $penduduk->golongan_darah, $document);
        
        
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[tgl_surat]", Date("d-m-Y"), $document);
        $document = str_replace("[jabatan]", $staff->staff_posisi, $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        
        
        $document = str_replace("[nama]", $penduduk->full_name, $document);
        $document = str_replace("[nama_pamong]", $staff->nama_staff, $document);

        $document = str_replace("[kode_desa]", $this->getIdentitas("kode_pos"), $document);
        $document = str_replace("[kode_surat]", $request->nomor_surat, $document);

        $filename = $surat->getTitleFile($request->kode_surat)."_".Date("Ymdhis").".doc";
        $filepath = public_path('data_surat')."\\".$filename;
        
        file_put_contents($filepath, $document);
        
        $result =   $this->save($request,$filename);


        return redirect('surat/get-surat/'.$result->surat_id);
    }
    public function cetak_surat_kelahiran(Request $request)
    {

        $surat = new Surat;
        
        $this->getIdentitalDesaAll();

        $staff = Staff::find($request->staf_id);

        $kelahiran = Kelahiran::join('penduduk', 'penduduk.penduduk_id', '=', 'kelahiran.penduduk_id')
        ->select('kelahiran.*','penduduk.nik','penduduk.full_name','penduduk.tanggal_lahir','penduduk.tempat_lahir','penduduk.jekel')
        ->where('penduduk.penduduk_id',$request->penduduk_id)->first();

        $ibu = Penduduk::find($kelahiran->id_penduduk_ibu);

        $ayah = Penduduk::find($kelahiran->id_penduduk_ayah);

        $penduduk = null;

        $nama_pelapor = "";
        $nik_pelapor = "";
        $tempat_lahir_pelapor = "";
        $tanggal_lahir_pelapor = "";
        $umur_pelapor = "";
        $pekerjaan_pelapor = "";
        $desa_pelapor = $this->getIdentitas("nama_desa");
        $kec_pelapor = $this->getIdentitas("nama_kec");
        $kab_pelapor = $this->getIdentitas("nama_kab");
        $provinsi_pelapor = $this->getIdentitas("nama_prov");
        $hubungan_pelapor = "";
        $lokasi_capil = "";

        $nama_saksi1 = "";
        $nik_saksi1 = "";
        $tempat_lahir_saksi1 = "";
        $tanggal_lahir_saksi1 = "";
        $umur_saksi1 = ""; 
        $pekerjaan_saksi1 ="";
        $desa_saksi1 = $this->getIdentitas("nama_desa");
        $kec_saksi1 = $this->getIdentitas("nama_kec");
        $kab_saksi1 = $this->getIdentitas("nama_kab");
        $provin_sisaksi1 = $this->getIdentitas("nama_prov");

        $nama_saksi2 = "";
        $nik_saksi2 = "";
        $tempat_lahir_saksi2 = "";
        $tanggal_lahir_saksi2 = "";
        $umur_saksi2 = "";
        $pekerjaan_saksi2 = "";
        $desa_saksi2 = $this->getIdentitas("nama_desa");
        $kec_saksi2 = $this->getIdentitas("nama_kec");
        $kab_saksi2 = $this->getIdentitas("nama_kab");
        $provinsi_saksi2 = $this->getIdentitas("nama_prov");
        
        $lokasi_capil = $request->lokasi_capil;

       if($request->pelapor_is_warga == "true")
       {
            $penduduk = Penduduk::find($request->penduduk_pelapor);

            if($penduduk !== null){
                $nama_pelapor = $penduduk->full_name;
                $nik_pelapor = $penduduk->nik;
                $tempat_lahir_pelapor = $penduduk->tempat_lahir;
                $tanggal_lahir_pelapor = $penduduk->tanggal_lahir;
                $umur_pelapor = date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y;
                $pekerjaan_pelapor = $penduduk->pekerjaan;
                $hubungan_pelapor = $penduduk->hubungan_keluarga;

            }

       }else
       {
            $nama_pelapor = $request->nama_pelapor;
            $nik_pelapor = $request->nik_pelapor;
            $tempat_lahir_pelapor = $request->tempat_lahir_pelapor;
            $tanggal_lahir_pelapor = $request->tanggal_lahir_pelapor;
            $umur_pelapor = date_diff(date_create($request->tanggal_lahir_pelapor), date_create('now'))->y;
            $pekerjaan_pelapor =$request->pekerjaan_pelapor;
            $desa_pelapor = $request->desa_pelapor;
            $kec_pelapor = $request->kec_pelapor;
            $kab_pelapor = $request->kab_pelapor;
            $provinsi_pelapor = $request->provinsi_pelapor;
            $hubungan_pelapor = $request->hubungan_pelapor;
       }

       
       if($request->saksi1_is_warga == "true")
       {

            $penduduk = Penduduk::find($request->penduduk_saksi1);
            $nama_saksi1 = $penduduk->full_name;
            $nik_saksi1 = $penduduk->nik;
            $tempat_lahir_saksi1 = $penduduk->tempat_lahir;
            $tanggal_lahir_saksi1 = $penduduk->tanggal_lahir;
            $umur_saksi1 = date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y; 
            $pekerjaan_saksi1 =$penduduk->pekerjaan;
       }else
       {
            $nama_saksi1 = $request->nama_saksi1;
            $nik_saksi1 = $request->nik_saksi1;
            $tempat_lahir_saksi1 = $request->tempat_lahir_saksi1;
            $tanggal_lahir_saksi1 = $request->tanggal_lahir_saksi1;
            $umur_saksi1 = date_diff(date_create($request->tanggal_lahir_saksi1), date_create('now'))->y;
            $pekerjaan_saksi1 = $request->pekerjaan_saksi1;
            $desa_saksi1 = $request->desa_saksi1;
            $kec_saksi1 = $request->kec_saksi1;
            $kab_saksi1 = $request->kab_saksi1;
            $provin_sisaksi1 = $request->provin_sisaksi1;
       }

       if($request->saksi2_is_warga  == "true")
       {
            $penduduk = Penduduk::find($request->penduduk_saksi2);
            $nama_saksi2 = $penduduk->full_name;
            $nik_saksi2 = $penduduk->nik;
            $tempat_lahir_saksi2 = $penduduk->tempat_lahir;
            $tanggal_lahir_saksi2 = $penduduk->tanggal_lahir;
            $umur_saksi2 = date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y;
            $pekerjaan_saksi2 = $penduduk->pekerjaan;
       }else
       {
            $nama_saksi2 = $request->nama_saksi2;
            $nik_saksi2 = $request->nik_saksi2;
            $tempat_lahir_saksi2 = $request->tempat_lahir_saksi2;
            $tanggal_lahir_saksi2 = $request->tanggal_lahir_saksi2;
            $umur_saksi2 = date_diff(date_create($request->tanggal_lahir_saksi2), date_create('now'))->y;
            $pekerjaan_saksi2 = $request->pekerjaan_saksi2;
            $desa_saksi2 = $request->desa_saksi2;
            $kec_saksi2 = $request->kec_saksi2;
            $kab_saksi2 =  $request->kab_saksi2;
            $provinsi_saksi2 = $request->provin_sisaksi2;
       }

        
        $document =  file_get_contents(public_path('master_surat').'\\'.$surat->getnamefile($request->kode_surat));
 
        $document = str_replace("[SEBUTAN_KABUPATEN]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[NAMA_KAB]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[SEBUTAN_KECAMATAN]", $this->getIdentitas("sebutan_kecamatan"), $document);
        $document = str_replace("[NAMA_KEC]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[NAMA_DES]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[alamat_des]", $this->getIdentitas("alamat_desa"), $document);
        
        
        
        $document = str_replace("[judul_surat]", $surat->getTitleFile($request->kode_surat), $document);
        $document = str_replace("[kode_surat]", $request->nomor_surat, $document);
        $document = str_replace("[nomor_surat]", $request->nomor_surat, $document);
        $document = str_replace("[kode_desa]",$this->getIdentitas("kode_pos"), $document);
        $document = str_replace("[tahun]", Date("Y"), $document);
        

        $document = str_replace("[jabatan]", $staff->staff_posisi, $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[sebutan_kecamatan]", $this->getIdentitas("sebutan_kecamatan"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_kabupaten]", $this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[nama_provinsi]", $this->getIdentitas("nama_prov"), $document);
        
        
        // data anak
        $document = str_replace("[form_hari]",$this->hari[date("N",strtotime($kelahiran->tanggal_lahir))], $document);
        $document = str_replace("[form_tanggallahir]",date("d-m-Y",strtotime($kelahiran->tanggal_lahir)), $document);
        $document = str_replace("[form_waktu_lahir]",$kelahiran->tob, $document);
        $document = str_replace("[form_tempatlahir]",$kelahiran->tempat_lahir, $document);
        $document = str_replace("[form_nama_sex]",$kelahiran->jekel, $document);
        $document = str_replace("[form_nama_bayi]",$kelahiran->full_name, $document);
        //

        // data Ibu
        $document = str_replace("[form_nama_ibu]",$ibu->full_name, $document);
        $document = str_replace("[nik_ibu]",$ibu->nik, $document);
        $document = str_replace("[umur_ibu]",date_diff(date_create($ibu->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[pekerjaanibu]",$ibu->pekerjaan, $document);
        $document = str_replace("[alamat_ibu]",$ibu->alamat, $document);
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[desaibu]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[kecibu]",$this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[kabibu]",$this->getIdentitas("nama_kab"), $document);
        //

        //data Ayah
        $document = str_replace("[form_nama_ayah]",$ayah->full_name, $document); 
        $document = str_replace("[nik_ayah]",$ayah->nik, $document);
        $document = str_replace("[umur_ayah]",date_diff(date_create($ayah->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[pekerjaanayah]",$ayah->pekerjaan, $document);
        $document = str_replace("[alamat_ayah]",$ayah->alamat, $document); 
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document); 
        $document = str_replace("[sebutan_kecamatan]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[desaayah]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[kecayah]",$this->getIdentitas("nama_kec"), $document); 
        $document = str_replace("[sebutan_kecamatan]",$this->getIdentitas("sebutan_kecamatan"), $document); 
        $document = str_replace("[kabayah]",$this->getIdentitas("nama_kab"), $document);
        //

        // data pelapor
        $document = str_replace("[form_nama_pelapor]",$nama_pelapor, $document); 
        $document = str_replace("[form_nik_pelapor]",$nik_pelapor, $document);
        $document = str_replace("[form_umur_pelapor]",$umur_pelapor, $document);
        $document = str_replace("[form_pekerjaanpelapor]",$pekerjaan_pelapor, $document);
        $document = str_replace("[form_desapelapor]",$desa_pelapor, $document); 
        $document = str_replace("[form_kecpelapor]",$kec_pelapor, $document); 
        $document = str_replace("[form_kabpelapor]",$kab_pelapor, $document); 
        $document = str_replace("[form_provinsipelapor]",$provinsi_pelapor, $document);
        $document = str_replace("[form_hubunganpelapor]",$hubungan_pelapor, $document);

        $document = str_replace("[nama_des]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[tgl_surat]",Date("d-m-Y"), $document);
        $document = str_replace("[jabatan]",$staff->staff_posisi, $document); 
        $document = str_replace("[nama_des]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[nama_pamong]",$staff->nama_staff, $document);

        // prihal
        $document = str_replace("[nama_kab]",$this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[lokasi_disdukcapil]",$lokasi_capil, $document);
        $document = str_replace("[nik_pelapor]",$nik_pelapor, $document);
        $document = str_replace("[nama_pelapor]",$nama_pelapor, $document);
        $document = str_replace("[tempat_lahir_pelapor]",$tempat_lahir_pelapor, $document);
        $document = str_replace("[tanggal_lahir_pelapor]",$tanggal_lahir_pelapor, $document); 
        $document = str_replace("[umur_pelapor]",date_diff(date_create($tanggal_lahir_pelapor), date_create('now'))->y, $document); 
        $document = str_replace("[pekerjaanpelapor]",$pekerjaan_pelapor, $document);
        $document = str_replace("[form_desapelapor]",$desa_pelapor, $document); 
        $document = str_replace("[form_kecpelapor]",$kec_pelapor, $document); 
        $document = str_replace("[form_kabpelapor]",$kab_pelapor, $document); 
        $document = str_replace("[form_provinsipelapor]",$provinsi_pelapor, $document);
        //
        
        // Akte
        $document = str_replace("[form_nama_bayi]",$kelahiran->full_name, $document); 
        $document = str_replace("[form_nama_sex]",$kelahiran->jekel, $document);
            
        $document = str_replace("[form_tempatlahir]",$kelahiran->tempat_lahir, $document);	
        $document = str_replace("[form_tanggallahir]",date("d-m-Y",strtotime($kelahiran->tanggal_lahir)), $document);	
        $document = str_replace("[form_kelahiran_anak_ke]",$kelahiran->anak_ke, $document);	
        //

        // ibu
        $document = str_replace("[form_nama_ibu]",$ibu->full_name, $document);
        $document = str_replace("[nik_ibu]",$ibu->nik, $document);
        $document = str_replace("[tempat_lahir_ibu]",$ibu->tempat_lahir, $document);
        $document = str_replace("[tanggal_lahir_ibu]",date("d-m-Y",strtotime($ibu->tanggal_lahir)), $document);
        $document = str_replace("[umur_ibu]",date_diff(date_create($ibu->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[pekerjaanibu]",$ibu->pekerjaan, $document);
        $document = str_replace("[alamat_ibu]",$ibu->alamat, $document);
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[desaibu]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[sebutan_kecamatan]",$this->getIdentitas("sebutan_kecamatan"), $document);
        $document = str_replace("[kecibu]",$this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_kabupaten]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[kabibu]",$this->getIdentitas("nama_kab"), $document);
        //


        // Ayah
        $document = str_replace("[form_nama_ayah]",$ayah->full_name, $document);
        $document = str_replace("[nik_ayah]",$ayah->nik, $document);
        $document = str_replace("[umur_ayah]",date_diff(date_create($ayah->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[pekerjaanayah]",$ayah->pekerjaan, $document);
        $document = str_replace("[alamat_ayah]",$ayah->alamat, $document);   
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[desaayah]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[sebutan_kecamatan]",$this->getIdentitas("sebutan_kecamatan"), $document);
        $document = str_replace("[kecayah]",$this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_kabupaten]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[kabayah]",$this->getIdentitas("nama_kab"), $document);
        //

        // saksi 1
        $document = str_replace("[nama_saksi1]",$nama_saksi1, $document);
        $document = str_replace("[nik_saksi1]",$nik_saksi1, $document);
        $document = str_replace("[tempat_lahir_saksi1]",$tempat_lahir_saksi1, $document);
        $document = str_replace("[tanggal_lahir_saksi1]",$tanggal_lahir_saksi1, $document); 
        $document = str_replace("[umur_saksi1]",$umur_saksi1, $document);
        $document = str_replace("[pekerjaansaksi1]",$pekerjaan_saksi1, $document);
        $document = str_replace("[form_desasaksi1]",$desa_saksi1, $document);
        $document = str_replace("[form_kecsaksi1]",$kec_saksi1, $document);
        $document = str_replace("[form_kabsaksi1]",$kab_saksi1, $document);
        $document = str_replace("[form_provinsisaksi1]",$provin_sisaksi1, $document);
        //


        // Saksi 2
        $document = str_replace("[nama_saksi2]",$nama_saksi2, $document);
        $document = str_replace("[nik_saksi2]",$nik_saksi2, $document);
        $document = str_replace("[tempat_lahir_saksi2]",$tempat_lahir_saksi2, $document);
        $document = str_replace("[tanggal_lahir_saksi2]",$tanggal_lahir_saksi2, $document);
        $document = str_replace("[umur_saksi2]",$umur_saksi2, $document);
        $document = str_replace("[pekerjaansaksi2]",$pekerjaan_saksi2, $document);
        $document = str_replace("[form_desasaksi2]",$desa_saksi2, $document); 
        $document = str_replace("[form_kecsaksi2]",$kec_saksi2, $document);
        $document = str_replace("[form_kabsaksi2]",$kab_saksi2, $document); 
        $document = str_replace("[form_provinsisaksi2]",$provinsi_saksi2, $document);
        //

        // footer
        $document = str_replace("[nama_des]",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[tgl_surat]",Date("d-m-Y"), $document);
        $document = str_replace("[form_nama_pelapor]",$nama_pelapor, $document);
        //
        $filename = $surat->getTitleFile($request->kode_surat)."_".Date("Ymdhis").".doc";
        $filepath = public_path('data_surat')."\\".$filename;
        
        file_put_contents($filepath, $document);
        
        $result =   $this->save($request,$filename);


        return redirect('surat/get-surat/'.$result->surat_id);
    }
    public function cetak_surat_penduduk_pindah(Request $request)
    {
        $surat = new Surat;

        $penduduk =  Penduduk::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('penduduk.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->where('penduduk.penduduk_id',$request->penduduk_id)->first();

        $staff = Staff::find($request->staf_id);

        $this->getIdentitalDesaAll();
        $document =  file_get_contents(public_path('master_surat').'\\'.$surat->getnamefile($request->kode_surat));
 
        $document = str_replace("[sebutan_kabupaten]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[alamat_des]", $this->getIdentitas("alamat_desa"), $document);

        $document = str_replace("[judul_surat]", $surat->getTitleFile($request->kode_surat), $document);
        $document = str_replace("[nomor_surat]", $request->nomor_surat, $document);
        $document = str_replace("[tahun]", Date("Y"), $document);

        $document = str_replace("[nama_provinsi]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[jabatan]", $staff->staff_posisi, $document);

        $document = str_replace("[nama]",$penduduk->full_name, $document);
        $document = str_replace("[tempatlahir]", $penduduk->tempat_lahir, $document);
        $document = str_replace("[tanggallahir]",date("d-m-Y",strtotime($penduduk->tanggal_lahir)), $document);
        $document = str_replace("[usia]", date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[warga_negara]", "Indonesia", $document);
        $document = str_replace("[agama]", $penduduk->agama, $document);
        $document = str_replace("[sex]",$penduduk->jekel, $document);
        $document = str_replace("[pekerjaan]",$penduduk->pekerjaan, $document);
        $document = str_replace("[no_ktp]",$penduduk->nik, $document);
        $document = str_replace("[alamat_jalan]",$penduduk->alamat, $document);
        $document = str_replace("[rt]",$penduduk->RT, $document);
        $document = str_replace("[rw]",$penduduk->RW, $document);
        $document = str_replace("[dusun]",$penduduk->DUSUN, $document);


        $document = str_replace("[form_alamat_tujuan]",$request->alamat_tujuan, $document);
        $document = str_replace("[form_rt_tujuan]", $request->rt_tujuan, $document);
        $document = str_replace("[form_rw_tujuan]",$request->rw_tujuan, $document);
        $document = str_replace("[Sebutan_dusun]",$this->getIdentitas("sebutan_dusun"), $document);
        $document = str_replace("[form_dusun_tujuan]", $request->dusun_tujuan, $document);
        $document = str_replace("[form_desa_tujuan]", $request->dusun_tujuan, $document);
        $document = str_replace("[form_kecamatan_tujuan]",$request->kecamatan_tujuan, $document);
        $document = str_replace("[form_kabupaten_tujuan]",$request->kabupaten_tujuan, $document);
        $document = str_replace("[alasan_pindah]",$request->alasan_pindah, $document);
        $document = str_replace("[form_tanggal_pindah]",date("d-m-Y",strtotime($request->tanggal_pindah)), $document);
        $document = str_replace("[jumlah_pengikut]",$request->keluarga !== null ? (count($request->keluarga)):0, $document);

       for($i=0; $i <= 7;$i++)
       {
        if(isset($request->keluarga[$i])){
            $keluarga =   Penduduk::find($request->keluarga[$i]);
            if($keluarga !== null)
            {
                $document = str_replace("[pindah_no_".($i+1)."]",($i+1), $document);
                $document = str_replace("[pindah_nik_".($i+1)."]",$keluarga->nik, $document);
                $document = str_replace("[pindah_nama_".($i+1)."]",$keluarga->full_name, $document);
                $document = str_replace("[ktp_berlaku".($i+1)."]","Seumur Hidup", $document);
                $document = str_replace("[pindah_shdk_".($i+1)."]",$keluarga->hubungan_keluarga, $document);
              
            }
        }
        else
        {
            $document = str_replace("[pindah_no_".($i+1)."]",($i+1), $document);
            $document = str_replace("[pindah_nik_".($i+1)."]","", $document);
            $document = str_replace("[pindah_nama_".($i+1)."]","", $document);
            $document = str_replace("[ktp_berlaku".($i+1)."]","", $document);
            $document = str_replace("[pindah_shdk_".($i+1)."]","", $document);
        }

       }
       $document = str_replace("[form_keterangan]",$request->keterangan, $document);

       $document = str_replace("[tgl_surat]",Date("d-m-Y"), $document);
       $document = str_replace("[nama_pamong]",$staff->nama_staff, $document);
       $document = str_replace("[pamong_nip]",$staff->staff_nip, $document);
       
       
        $filename = $surat->getTitleFile($request->kode_surat)."_".Date("Ymdhis").".doc";
        $filepath = public_path('data_surat')."\\".$filename;
        
        file_put_contents($filepath, $document);
        
        $result =   $this->save($request,$filename);


        return redirect('surat/get-surat/'.$result->surat_id);
    }
    public function cetak_surat_kurang_mampu(Request $request)
    {
        $surat = new Surat;

        $keluarga = array();

        $penduduk =  Penduduk::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('penduduk.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->where('penduduk.penduduk_id',$request->penduduk_id)->first();
        
        $staff = Staff::find($request->staf_id);

        $this->getIdentitalDesaAll();

        $kepala_keluarga = Penduduk::where('keluarga_id','=',$penduduk->keluarga_id)
                           ->where('hubungan_keluarga','=','KEPALA KELUARGA')->first();

        $suami = Penduduk::where('keluarga_id','=',$penduduk->keluarga_id)
                        ->where('hubungan_keluarga','=','SUAMI')->first();

        $istri = Penduduk::where('keluarga_id','=',$penduduk->keluarga_id)
                        ->where('hubungan_keluarga','=','ISTRI')->get();

        $lainya = Penduduk::where('keluarga_id','=',$penduduk->keluarga_id)
                           ->where('hubungan_keluarga','!=','ISTRI')
                           ->where('hubungan_keluarga','!=','KEPALA KELUARGA')
                           ->where('hubungan_keluarga','!=','SUAMI')->get();

        if($kepala_keluarga !== null){
            array_push($keluarga,array(
                'nik' => $kepala_keluarga->nik,
                'nama' => $kepala_keluarga->full_name,
                'jk' => $kepala_keluarga->jekel,
                't_lahir' => $kepala_keluarga->tempat_lahir,
                'tgl_lahir' => $kepala_keluarga->tanggal_lahir,
                'hubungan' => $kepala_keluarga->hubungan_keluarga 
    
            ));
        }
        
        if($suami !== null){
            array_push($keluarga,array(
                'nik' => $suami->nik,
                'nama' => $suami->full_name,
                'jk' => $suami->jekel,
                't_lahir' => $suami->tempat_lahir,
                'tgl_lahir' => $suami->tanggal_lahir,
                'hubungan' => $suami->hubungan_keluarga 

            ));
        }

        foreach($istri as $key => $val)
        {
            array_push($keluarga,array(
                'nik' => $val->nik,
                'nama' => $val->full_name,
                'jk' => $val->jekel,
                't_lahir' => $val->tempat_lahir,
                'tgl_lahir' => $val->tanggal_lahir,
                'hubungan' => $val->hubungan_keluarga 

            ));
        }

        foreach($lainya as $key => $val)
        {
            array_push($keluarga,array(
                'nik' => $val->nik,
                'nama' => $val->full_name,
                'jk' => $val->jekel,
                't_lahir' => $val->tempat_lahir,
                'tgl_lahir' => $val->tanggal_lahir,
                'hubungan' => $val->hubungan_keluarga 

            ));
        }


        $document =  file_get_contents(public_path('master_surat').'\\'.$surat->getnamefile($request->kode_surat));
 
        $document = str_replace("[sebutan_kabupaten]",$this->getIdentitas("sebutan_kabupaten"), $document);
        $document = str_replace("[nama_kab]", $this->getIdentitas("nama_kab"), $document);
        $document = str_replace("[nama_kec]", $this->getIdentitas("nama_kec"), $document);
        $document = str_replace("[sebutan_desa]",$this->getIdentitas("sebutan_desa"), $document);
        $document = str_replace("[nama_des]", $this->getIdentitas("nama_desa"), $document);
        $document = str_replace("[alamat_des]", $this->getIdentitas("alamat_desa"), $document);

        $document = str_replace("[judul_surat]", $surat->getTitleFile($request->kode_surat), $document);
        $document = str_replace("[nomor_surat]", $request->nomor_surat, $document);
        $document = str_replace("[tahun]", Date("Y"), $document);

        $document = str_replace("[nama_provinsi]", $this->getIdentitas("nama_prov"), $document);
        $document = str_replace("[jabatan]", $staff->staff_posisi, $document);

        $document = str_replace("[nama]",$penduduk->full_name, $document);
        $document = str_replace("[tempatlahir]", $penduduk->tempat_lahir, $document);
        $document = str_replace("[tanggallahir]",date("d-m-Y",strtotime($penduduk->tanggal_lahir)), $document);
        $document = str_replace("[usia]", date_diff(date_create($penduduk->tanggal_lahir), date_create('now'))->y, $document);
        $document = str_replace("[warga_negara]", "Indonesia", $document);
        $document = str_replace("[agama]", $penduduk->agama, $document);
        $document = str_replace("[sex]",$penduduk->jekel, $document);
        $document = str_replace("[pekerjaan]",$penduduk->pekerjaan, $document);
        $document = str_replace("[no_ktp]",$penduduk->nik, $document);
        $document = str_replace("[alamat_jalan]",$penduduk->alamat, $document);
        $document = str_replace("[rt]",$penduduk->RT, $document);
        $document = str_replace("[rw]",$penduduk->RW, $document);
        $document = str_replace("[dusun]",$penduduk->DUSUN, $document);

     

       for($i=0; $i <= 7;$i++)
       {
        if(isset($keluarga[$i])){

            $document = str_replace("[anggota_no_".($i+1)."]",($i+1), $document);
            $document = str_replace("[anggota_nik_".($i+1)."]",$keluarga[$i]['nik'], $document);
            $document = str_replace("[anggota_nama_".($i+1)."]",$keluarga[$i]['nama'], $document);
            $document = str_replace("[anggota_sex_".($i+1)."]",$keluarga[$i]['jk'], $document);
            $document = str_replace("[anggota_tempatlahir_".($i+1)."]",$keluarga[$i]['t_lahir'], $document);
            $document = str_replace("[anggota_tanggallahir_".($i+1)."]",date("d-m-Y",strtotime($keluarga[$i]['tgl_lahir'])), $document);
            $document = str_replace("[anggota_shdk_".($i+1)."]",$keluarga[$i]['hubungan'], $document);

        }
        else
        {
            $document = str_replace("[anggota_no_".($i+1)."]",($i+1), $document);
            $document = str_replace("[anggota_nik_".($i+1)."]","", $document);
            $document = str_replace("[anggota_nama_".($i+1)."]","", $document);
            $document = str_replace("[anggota_sex_".($i+1)."]","", $document);
            $document = str_replace("[anggota_tempatlahir_".($i+1)."],","", $document);
            $document = str_replace("[anggota_tanggallahir_".($i+1)."]","", $document);
            $document = str_replace("[anggota_shdk_".($i+1)."]","", $document);
        }

       }

       $document = str_replace("[keperluan]",$request->hal, $document);
       $document = str_replace("[nama_des]",$this->getIdentitas("nama_desa"), $document);
       $document = str_replace("[tgl_surat]",Date("d-m-Y"), $document);
       $document = str_replace("[jabatan]",$staff->staff_posisi, $document);
       $document = str_replace("[nama_pamong]",$staff->nama_staff, $document);
       $document = str_replace("[form_pamong_nip]",$staff->staff_nip, $document);
       
       
        $filename = $surat->getTitleFile($request->kode_surat)."_".Date("Ymdhis").".doc";
        $filepath = public_path('data_surat')."\\".$filename;
        
        file_put_contents($filepath, $document);
        
        $result =   $this->save($request,$filename);


        return redirect('surat/get-surat/'.$result->surat_id);
    }
    public function get_surat($id)
    {
        $surat = Surat::find($id);

        $document = public_path("data_surat\\").$surat->surat_filename;

        return response()->download($document);
       
    }

    public function salinan_kk($id)
    {
        $Daftarkeluarga = array();
        $this->getIdentitalDesaAll();

        $keluarga = Keluarga::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'keluarga.wilayah_dusun')
        ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'keluarga.wilayah_rw')
        ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'keluarga.wilayah_rt')
        ->where('keluarga_id','=',$id)
        ->select('keluarga.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->first();

        $kepala_keluarga = Penduduk::leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
            ->leftjoin('wilayah as  rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
            ->leftjoin('wilayah as  rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
            ->where('hubungan_keluarga','=','KEPALA KELUARGA')
            ->where('keluarga_id','=',$id)
            ->select('penduduk.*', 'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
            ->first();

        $suami = Penduduk::where('keluarga_id','=',$id)
            ->where('hubungan_keluarga','=','SUAMI')->first();

        $istri = Penduduk::where('keluarga_id','=',$id)
            ->where('hubungan_keluarga','=','ISTRI')->get();

        $lainya = Penduduk::leftjoin('kelahiran as  klh', 'klh.penduduk_id', '=', 'penduduk.penduduk_id')
                ->leftjoin('penduduk as  ayah', 'ayah.penduduk_id', '=', 'klh.id_penduduk_ayah')
                ->leftjoin('penduduk as  ibu', 'ibu.penduduk_id', '=', 'klh.id_penduduk_ibu')
                ->where('penduduk.keluarga_id','=',$id)
                ->where('penduduk.hubungan_keluarga','!=','ISTRI')
                ->where('penduduk.hubungan_keluarga','!=','KEPALA KELUARGA')
                ->where('penduduk.hubungan_keluarga','!=','SUAMI')
                ->select('penduduk.*', 'ayah.full_name as AYAH','ibu.full_name as IBU')
                ->get();

        if($kepala_keluarga !== null){
            array_push($Daftarkeluarga,array(
            'nik' => $kepala_keluarga->nik,
            'nama' => $kepala_keluarga->full_name,
            'jk' => $kepala_keluarga->jekel,
            't_lahir' => $kepala_keluarga->tempat_lahir,
            'tgl_lahir' => $kepala_keluarga->tanggal_lahir,
            'hubungan' => $kepala_keluarga->hubungan_keluarga,
            'agama' => $kepala_keluarga->agama,
            'pendidikan' => $kepala_keluarga->pendidikan,
            'pekerjaan' => $kepala_keluarga->pekerjaan, 
            'status'  =>  $kepala_keluarga->status_perkawinan,
            'ayah' => '',
            'ibu' => '',
            'darah' =>  $kepala_keluarga->golongan_darah,
            'status_warganegara' => $kepala_keluarga->status_warganegara,
            'no_paspor' => $kepala_keluarga->no_paspor,
            'no_kitas_kitap' => $kepala_keluarga->no_kitas_kitap,
            'nama_ayah'  => $kepala_keluarga->nama_ayah,
            'nama_ibu'  => $kepala_keluarga->nama_ibu
            ));
        }

        if($suami !== null){
            array_push($Daftarkeluarga,array(
            'nik' => $suami->nik,
            'nama' => $suami->full_name,
            'jk' => $suami->jekel,
            't_lahir' => $suami->tempat_lahir,
            'tgl_lahir' => $suami->tanggal_lahir,
            'hubungan' => $suami->hubungan_keluarga,
            'agama' => $suami->agama,
            'pendidikan' => $suami->pendidikan,
            'pekerjaan' => $suami->pekerjaan, 
            'status'  =>  $suami->status_perkawinan, 
            'ayah' => '',
            'ibu' => '',
            'darah' =>  $suami->golongan_darah,
            'status_warganegara' => $suami->status_warganegara,
            'no_paspor' => $suami->no_paspor,
            'no_kitas_kitap' => $suami->no_kitas_kitap,
            'nama_ayah'  => $suami->nama_ayah,
            'nama_ibu'  => $suami->nama_ibu
            ));
        }

        foreach($istri as $key => $val)
        {
            array_push($Daftarkeluarga,array(
            'nik' => $val->nik,
            'nama' => $val->full_name,
            'jk' => $val->jekel,
            't_lahir' => $val->tempat_lahir,
            'tgl_lahir' => $val->tanggal_lahir,
            'hubungan' => $val->hubungan_keluarga ,
            'agama' => $val->agama,
            'pendidikan' => $val->pendidikan,
            'pekerjaan' => $val->pekerjaan,
            'status'  =>  $val->status_perkawinan, 
            'ayah' => '',
            'ibu' => '',
            'darah' =>  $val->golongan_darah,
            'status_warganegara' => $val->status_warganegara,
            'no_paspor' => $val->no_paspor,
            'no_kitas_kitap' => $val->no_kitas_kitap,
            'nama_ayah'  => $val->nama_ayah,
            'nama_ibu'  => $val->nama_ibu
            ));
        }

        foreach($lainya as $key => $val)
        {
            array_push($Daftarkeluarga,array(
            'nik' => $val->nik,
            'nama' => $val->full_name,
            'jk' => $val->jekel,
            't_lahir' => $val->tempat_lahir,
            'tgl_lahir' => $val->tanggal_lahir,
            'hubungan' => $val->hubungan_keluarga,
            'agama' => $val->agama,
            'pendidikan' => $val->pendidikan,
            'pekerjaan' => $val->pekerjaan,
            'status'  =>  $val->status_perkawinan,
            'ayah' => $val->AYAH,
            'ibu' => $val->IBU,
            'darah' =>  $val->golongan_darah,
            'status_warganegara' => $val->status_warganegara,
            'no_paspor' => $val->no_paspor,
            'no_kitas_kitap' => $val->no_kitas_kitap,
            'nama_ayah'  => $val->nama_ayah,
            'nama_ibu'  => $val->nama_ibu
            ));
        }

        $no ="";
        $nama ="";
        $nik ="";
        $sex ="";
        $t_lahir ="";
        $tgl_lahir ="";
        $agama ="";
        $pendidikan ="";
        $pekerjaan ="";


        $kawin ="";
        $hubungan ="";
        $warga_negra ="";
        $pasport ="";
        $kitas ="";
        $ayah ="";
        $ibu ="";
        $darah ="";

        foreach($Daftarkeluarga as $key => $val)
        {
            $no .= ($key + 1)." \line ";
            $nama .= $this->CheckValue($Daftarkeluarga[$key]['nama'])." \line ";
            $nik .= $this->CheckValue($Daftarkeluarga[$key]['nik'])." \line ";
            $sex .= $this->CheckValue($Daftarkeluarga[$key]['jk'])." \line ";
            $t_lahir .= $this->CheckValue($Daftarkeluarga[$key]['t_lahir'])." \line ";
            $tgl_lahir .= $this->CheckValue(date("d-m-Y",strtotime($Daftarkeluarga[$key]['tgl_lahir'])))." \line ";
            $agama .= $this->CheckValue($Daftarkeluarga[$key]['agama'])." \line ";
            $pendidikan .= $this->CheckValue($Daftarkeluarga[$key]['pendidikan'])." \line ";
            $pekerjaan .= $this->CheckValue($Daftarkeluarga[$key]['pekerjaan'])." \line ";


            $kawin .= $this->CheckValue($Daftarkeluarga[$key]['status'])." \line ";
            $hubungan .= $this->CheckValue($Daftarkeluarga[$key]['hubungan'])." \line ";
            $warga_negra .=  $this->CheckValue($Daftarkeluarga[$key]['status_warganegara'])." \line ";
            $pasport .=  $this->CheckValue($Daftarkeluarga[$key]['no_paspor'])." \line ";
            $kitas .=  $this->CheckValue($Daftarkeluarga[$key]['no_kitas_kitap'])." \line ";
            $ayah .= $this->CheckValue($Daftarkeluarga[$key]['nama_ayah'])." \line ";
            $ibu .= $this->CheckValue($Daftarkeluarga[$key]['nama_ibu'])." \line ";
            $darah .= $this->CheckValue($Daftarkeluarga[$key]['darah'])." \line ";
        }

        $document =  file_get_contents(public_path('master_surat').'\\'."kk.rtf");
 
        $document = str_replace("*kk",$kepala_keluarga->full_name, $document);
        $document = str_replace("alamat_plus_dusun",$keluarga->alamat_keluarga." : ".$keluarga->DUSUN, $document);
        $document = str_replace("*rt",$keluarga->RT, $document);
        $document = str_replace("*rw", $keluarga->RW, $document);
        $document = str_replace("desa",$this->getIdentitas("nama_desa"), $document);
        $document = str_replace("no_kk",$keluarga->no_kk, $document);

        $document = str_replace("kec",$this->getIdentitas("nama_kec"), $document);
        $document = str_replace("kab",$this->getIdentitas("nama_kab"), $document);
        $document = str_replace("pos",$this->getIdentitas("kode_pos"), $document);
        $document = str_replace("prop",$this->getIdentitas("nama_prov"), $document);

        $document = str_replace("[no]",$no, $document);
        $document = str_replace("[nama]",$nama, $document);
        $document = str_replace("[nik]",$nik, $document);
        $document = str_replace("[sex]",$sex, $document);
        $document = str_replace("[tempatlahir]",$t_lahir, $document);
        $document = str_replace("[tanggallahir]",$tgl_lahir, $document);
        $document = str_replace("[agama]",$agama, $document);
        $document = str_replace("[pendidikan]",$pendidikan, $document);
        $document = str_replace("[pekerjaan]",$pekerjaan, $document);

        $document = str_replace("[kawin]",$kawin, $document);
        $document = str_replace("[hubungan]",$hubungan, $document);
        $document = str_replace("[warganegara]",$warga_negra, $document);
        $document = str_replace("[pasport]",$pasport, $document);
        $document = str_replace("[kitas]",$kitas, $document);
        $document = str_replace("[ayah]",$ayah, $document);
        $document = str_replace("[ibu]",$ibu, $document);
        $document = str_replace("[darah]",$darah, $document);

        $document = str_replace("*camat",$this->getIdentitas("nama_camat"), $document);
        $document = str_replace("*nip_camat",$this->getIdentitas("nip_camat"), $document);
        $document = str_replace("*kades",$this->getIdentitas("nama_kades"), $document);
        $document = str_replace("*kk", $kepala_keluarga->full_name, $document);
        $document = str_replace("*tertanda","", $document);
     

        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=Salinan_KK.doc");
        header("Content-length: " . strlen($document));

        echo $document;
    }

    public function rekap_surat(Request $request)
    {
        $surat = new Surat;
        $surat = $surat->newQuery();
        
        $filter = array(
            'startDate' => isset($request->startDate)? $request->startDate : null,
            'endDate'   => isset($request->endDate)? $request->endDate : null
        );

        $result = array();
        

        $surat->join('penduduk','penduduk.penduduk_id','=','surat.penduduk_id')
              ->join('staff','staff.staff_id','=','surat.staff_id')
              ->select('surat.*','penduduk.full_name as nama_penduduk','staff.nama_staff as nama_staff');



       if(isset($request->startDate))
        {
           
            $surat->where('tanggal','>=',$request->startDate);
        }

        if(isset($request->endDate))
        {
           
            $surat->where('tanggal','<=',$request->endDate);
        }
    
        $result = $surat->get();

        return View("pages.surat.rekap_surat",['surat' => $result,'filter' => $filter]);

    }

    public function CheckValue($val)
    {
        return $val == "" || $val == null? "-": $val;

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
