<?php

namespace App\Exports;

use App\Kematian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KematianExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $kematian = Kematian::join('penduduk', 'penduduk.penduduk_id', '=', 'kematian.penduduk_id')
        ->leftjoin('keluarga','keluarga.keluarga_id','=','penduduk.keluarga_id')
        ->leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('kematian.*','penduduk.nik','penduduk.full_name','keluarga.no_kk as no_kk',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.kematian_def', ['kematian' => $kematian]);
    }
}
