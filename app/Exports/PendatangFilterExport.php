<?php

namespace App\Exports;

use App\Pendatang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendatangFilterExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $tgl_awal;
    protected $tgl_akhir;

    function __construct($tgl_awal, $tgl_akhir)
    {
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }

    public function view(): View
    {
        $pendatang = Pendatang::join('penduduk', 'penduduk.penduduk_id', '=', 'pendatang.penduduk_id')
        ->join('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->join('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->join('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->select('pendatang.*','penduduk.nik','penduduk.full_name','penduduk.jekel',
            'penduduk.tempat_lahir', 'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->whereBetween('tgl_datang', [$this->tgl_awal, $this->tgl_akhir])
        ->get();
        return view('pages.laporan.pendatang_def', ['pendatang' => $pendatang]);
    }
}
