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
        ->select('penduduk_pindah.*','penduduk.nik','penduduk.full_name')
        ->get();
        return view('pages.laporan.penduduk_pindah_def', ['pnd_pindah' => $pnd_pindah]);
    }
}
