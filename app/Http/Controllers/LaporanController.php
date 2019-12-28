<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\PendudukPindah;
use App\Exports\PendudukPindahExport;
use App\Exports\PendudukPindahFilterExport;

use App\Pendatang;
use App\Exports\PendatangExport;
use App\Exports\PendatangFilterExport;

use App\Kelahiran;
use App\Exports\KelahiranExport;
use App\Exports\KelahiranFilterExport;

use App\Kematian;
use App\Exports\KematianExport;
use App\Exports\KematianFilterExport;

class LaporanController extends Controller
{
    //region Laporan Penduduk Pindah
    public function penduduk_pindah()
    {
        $pnd_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name','penduduk.no_kk','penduduk.jekel',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.penduduk_pindah', ['pnd_pindah' => $pnd_pindah]);
    }

    public function penduduk_pindah_filter($tgl_awal, $tgl_akhir)
    {
        $pnd_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name','penduduk.no_kk','penduduk.jekel',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->whereBetween('tgl_pindah', [$tgl_awal, $tgl_akhir])
        ->get();
        return view('pages.laporan.penduduk_pindah', ['pnd_pindah' => $pnd_pindah]);
    }

    public function excel_penduduk_pindah()
    {
        return Excel::download(new PendudukPindahExport, 'penduduk-pindah_'.date("YmdHis").'.xlsx');
    }

    public function excel_penduduk_pindah_filter(Request $request)
    {
        return Excel::download(new PendudukPindahFilterExport($request->tgl_awal, $request->tgl_akhir), 
            'penduduk-pindah_'.date("YmdHis").'.xlsx');
        
    }
    //endregion Laporan Penduduk Pindah

    //region Laporan Pendatang
    public function pendatang()
    {
        $pendatang = Pendatang::join('penduduk', 'penduduk.penduduk_id', '=', 'pendatang.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('pendatang.*','penduduk.nik','penduduk.full_name','penduduk.jekel',
            'penduduk.tempat_lahir', 'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.pendatang', ['pendatang' => $pendatang]);
    }

    public function pendatang_filter($tgl_awal, $tgl_akhir)
    {
        $pendatang = Pendatang::join('penduduk', 'penduduk.penduduk_id', '=', 'pendatang.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('pendatang.*','penduduk.nik','penduduk.full_name','penduduk.jekel',
            'penduduk.tempat_lahir', 'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->whereBetween('tgl_datang', [$tgl_awal, $tgl_akhir])
        ->get();
        return view('pages.laporan.pendatang', ['pendatang' => $pendatang]);
    }

    public function excel_pendatang()
    {
        return Excel::download(new PendatangExport, 'pendatang_'.date("YmdHis").'.xlsx');
    }

    public function excel_pendatang_filter(Request $request)
    {
        return Excel::download(new PendatangFilterExport($request->tgl_awal, $request->tgl_akhir), 
            'pendatang_'.date("YmdHis").'.xlsx');
        
    }
    //endregion Laporan Pendatang

    //region Laporan Kelahiran
    public function kelahiran()
    {
        $kelahiran = Kelahiran::join('penduduk', 'penduduk.penduduk_id', '=', 'kelahiran.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->leftjoin('penduduk as ibu','ibu.penduduk_id','=','kelahiran.id_penduduk_ibu')
        ->leftjoin('penduduk as ayah','ayah.penduduk_id','=','kelahiran.id_penduduk_ayah')
        ->select('kelahiran.*','penduduk.nik','penduduk.full_name','penduduk.no_kk','penduduk.jekel',
            'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'ibu.full_name as IBU', 'ayah.full_name as AYAH',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.kelahiran', ['kelahiran' => $kelahiran]);
    }

    public function kelahiran_filter($tgl_awal, $tgl_akhir)
    {
        $kelahiran = Kelahiran::join('penduduk', 'penduduk.penduduk_id', '=', 'kelahiran.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->leftjoin('penduduk as ibu','ibu.penduduk_id','=','kelahiran.id_penduduk_ibu')
        ->leftjoin('penduduk as ayah','ayah.penduduk_id','=','kelahiran.id_penduduk_ayah')
        ->select('kelahiran.*','penduduk.nik','penduduk.full_name','penduduk.no_kk','penduduk.jekel',
            'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'ibu.full_name as IBU', 'ayah.full_name as AYAH',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->whereBetween('penduduk.tanggal_lahir', [$tgl_awal, $tgl_akhir])
        ->get();
        return view('pages.laporan.kelahiran', ['kelahiran' => $kelahiran]);
    }

    public function excel_kelahiran()
    {
        return Excel::download(new KelahiranExport, 'kelahiran_'.date("YmdHis").'.xlsx');
    }

    public function excel_kelahiran_filter(Request $request)
    {
        return Excel::download(new KelahiranFilterExport($request->tgl_awal, $request->tgl_akhir), 
            'kelahiran_'.date("YmdHis").'.xlsx');
        
    }
    //endregion Laporan Kelahiran

    //region Laporan Kematian
    public function kematian()
    {
        $kematian = Kematian::join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('kematian.*','penduduk.nik','penduduk.full_name','penduduk.no_kk',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.kematian', ['kematian' => $kematian]);
    }

    public function kematian_filter($tgl_awal, $tgl_akhir)
    {
        $kematian = Kematian::join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('kematian.*','penduduk.nik','penduduk.full_name','penduduk.no_kk',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
            ->whereBetween('tgl_kematian', [$tgl_awal, $tgl_akhir])
        ->get();
        return view('pages.laporan.kematian', ['kematian' => $kematian]);
    }

    public function excel_kematian()
    {
        return Excel::download(new KematianExport, 'kematian_'.date("YmdHis").'.xlsx');
    }

    public function excel_kematian_filter(Request $request)
    {
        return Excel::download(new KematianFilterExport($request->tgl_awal, $request->tgl_akhir), 
            'kematian_'.date("YmdHis").'.xlsx');
        
    }
    //endregion Laporan Kematian
}