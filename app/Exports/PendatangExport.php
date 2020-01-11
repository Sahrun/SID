<?php

namespace App\Exports;

use App\Pendatang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendatangExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $pendatang = Pendatang::join('penduduk', 'penduduk.penduduk_id', '=', 'pendatang.penduduk_id')
        ->leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('pendatang.*','penduduk.nik','penduduk.full_name','penduduk.jekel',
            'penduduk.tempat_lahir', 'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.pendatang_def', ['pendatang' => $pendatang]);
    }
}
