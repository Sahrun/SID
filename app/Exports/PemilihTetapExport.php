<?php

namespace App\Exports;

use App\Pendatang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PemilihTetapExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $data_pemilih_tetap;

    function __construct($data_pemilih_tetap)
    {
        $this->data_pemilih_tetap = $data_pemilih_tetap;
    }

    public function view(): View
    {
        return view('pages.kependudukan.penduduk.excel_pemilih_tetap_def', ['pemilihtetap' => $this->data_pemilih_tetap]);
    }
}
