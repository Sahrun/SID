<?php

namespace App\Exports;

use App\PendudukPindah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendudukPindahExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $pnd_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name','penduduk.no_kk','penduduk.jekel',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.penduduk_pindah_def', ['pnd_pindah' => $pnd_pindah]);
    }
}
