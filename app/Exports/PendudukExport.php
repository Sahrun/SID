<?php

namespace App\Exports;

use App\Penduduk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendudukExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $penduduk = Penduduk::where('status_kependudukan','!=',"Meninggal")
            ->leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
            ->leftjoin('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
            ->leftjoin('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
            ->where('status_kependudukan','!=',"Pindah")
            ->orWhereNull('status_kependudukan')
            ->select('penduduk.*',
                'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
            ->get();
        return view('pages.kependudukan.penduduk.excel_def', ['penduduk' => $penduduk]);
    }
}
