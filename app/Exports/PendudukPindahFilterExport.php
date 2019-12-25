<?php

namespace App\Exports;

use App\PendudukPindah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendudukPindahFilterExport implements FromView, ShouldAutoSize
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
        $pnd_pindah = $pnd_pindah = PendudukPindah::join('penduduk', 'penduduk.penduduk_id', '=', 'penduduk_pindah.penduduk_id')
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name')
        ->whereBetween('tgl_pindah', [$this->tgl_awal, $this->tgl_akhir])
        ->get();
        return view('pages.laporan.penduduk_pindah_def', ['pnd_pindah' => $pnd_pindah]);
    }
}
