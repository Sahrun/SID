<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

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
use App\Penduduk;

class LaporanController extends Controller
{
    public function statistik()
    {
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

        $pendidikan = Penduduk::select(DB::raw('ifnull(pendidikan, "Belum isi data") as pendidikan, count(*) as jumlah'))
        ->where([
            ['status_kependudukan', '<>', 'Meninggal'],
            ['status_kependudukan', '<>', 'Pindah']
        ])
        ->groupBy('pendidikan')
        ->get();

        $status_kependudukan = Penduduk::select(DB::raw('ifnull(status_kependudukan, "Belum isi data") as status_kependudukan, count(*) as jumlah'))
        ->groupBy('status_kependudukan')
        ->get();

        $umur = Penduduk::select(DB::raw('case 
            when timestampdiff(year, tanggal_lahir, current_date()) between 0 and 2 then "0 - 2"
            when timestampdiff(year, tanggal_lahir, current_date()) between 3 and 5 then "3 - 5"
            when timestampdiff(year, tanggal_lahir, current_date()) between 6 and 12 then "6 - 12"
            when timestampdiff(year, tanggal_lahir, current_date()) between 13 and 17 then "13 - 17"
            when timestampdiff(year, tanggal_lahir, current_date()) between 18 and 25 then "18 - 25"
            when timestampdiff(year, tanggal_lahir, current_date()) between 26 and 35 then "26 - 35"
            when timestampdiff(year, tanggal_lahir, current_date()) between 36 and 40 then "36 - 40"
            when timestampdiff(year, tanggal_lahir, current_date()) between 41 and 50 then "41 - 50"
            when timestampdiff(year, tanggal_lahir, current_date()) between 51 and 70 then "51 - 70"
            when timestampdiff(year, tanggal_lahir, current_date()) > 70 then "> 70"
            when tanggal_lahir is null then "Belum isi data"
            end as umur, count(*) as jumlah'))
        ->where([
            ['status_kependudukan', '<>', 'Meninggal'],
            ['status_kependudukan', '<>', 'Pindah']
        ])
        ->groupBy('umur')
        ->get();

        return view('pages.laporan.statistik', ['jen_kel' => $jen_kel, 'agama' => $agama, 'pendidikan' => $pendidikan,
            'status_kependudukan' => $status_kependudukan, 'umur' => $umur]);
    }

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
