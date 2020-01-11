<?php

namespace App\Exports;

use App\Kelahiran;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KelahiranExport implements WithColumnFormatting, FromView, ShouldAutoSize
{
    use Exportable;

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT
        ];
    }

    public function view(): View
    {
        $kelahiran = Kelahiran::join('penduduk', 'penduduk.penduduk_id', '=', 'kelahiran.penduduk_id')
        ->leftjoin('wilayah as dusun', 'dusun.wilayah_id', '=', 'penduduk.wilayah_dusun')
        ->leftjoin('wilayah as rw', 'rw.wilayah_id', '=', 'penduduk.wilayah_rw')
        ->leftjoin('wilayah as rt', 'rt.wilayah_id', '=', 'penduduk.wilayah_rt')
        ->leftjoin('penduduk as ibu','ibu.penduduk_id','=','kelahiran.id_penduduk_ibu')
        ->leftjoin('penduduk as ayah','ayah.penduduk_id','=','kelahiran.id_penduduk_ayah')
        ->select('kelahiran.*','penduduk.nik','penduduk.full_name','penduduk.no_kk','penduduk.jekel',
            'penduduk.tanggal_lahir', 'penduduk.agama', 'penduduk.pekerjaan',
            'ibu.full_name as IBU', 'ayah.full_name as AYAH',
            'dusun.wilayah_nama as DUSUN','rw.wilayah_nama as RW','rt.wilayah_nama as RT')
        ->get();
        return view('pages.laporan.kelahiran_def', ['kelahiran' => $kelahiran]);
    }
}
