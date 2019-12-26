<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\PendudukPindah;
use App\Exports\PendudukPindahExport;
use App\Exports\PendudukPindahFilterExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function penduduk_pindah()
    {
        $pnd_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name')
        ->get();
        return view('pages.laporan.penduduk_pindah', ['pnd_pindah' => $pnd_pindah]);
    }

    public function penduduk_pindah_filter($tgl_awal, $tgl_akhir)
    {
        $pnd_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name')
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
}
