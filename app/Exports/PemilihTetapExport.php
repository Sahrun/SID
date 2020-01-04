<?php

namespace App\Exports;

use App\Pendatang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PemilihTetapExport implements FromView,WithColumnFormatting, ShouldAutoSize
{
    use Exportable;

    protected $data_pemilih_tetap;

    function __construct($data_pemilih_tetap)
    {
        $this->data_pemilih_tetap = $data_pemilih_tetap;
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function view(): View
    {
        
        return view('pages.kependudukan.penduduk.excel_pemilih_tetap_def', ['pemilihtetap' => $this->data_pemilih_tetap]);
    }
}
