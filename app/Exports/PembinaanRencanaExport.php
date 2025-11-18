<?php

namespace App\Exports;

use App\Models\PembinaanMental;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembinaanRencanaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return PembinaanMental::with('satker')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'periode' => $item->periode,
                    'program_kegiatan' => $item->program_kegiatan,
                    'ruang_lingkup' => $item->ruang_lingkup,
                    'waktu' => $item->waktu,
                    'tema' => $item->tema,
                    'tempat' => $item->tempat,
                    'waktu_pelaksanaan' => $item->waktu_pelaksanaan,
                    'peran_pejabat_administrator' => $item->peran_pejabat_administrator,
                    'narasi_singkat_peran' => $item->narasi_singkat_peran,
                    'jumlah_peserta' => $item->jumlah_peserta,
                    'output_manfaat' => $item->output_manfaat,
                    'link_dokumentasi' => $item->_link_dokumentasi,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'no',
            'periode',
            'program_kegiatan',
            'ruang_lingkup',
            'waktu',
            'tema',
            'tempat',
            'waktu_pelaksanaan',
            'peran_pejabat_administrator',
            'narasi_singkat_peran',
            'jumlah_peserta',
            'output_manfaat',
            'link_dokumentasi',
        ];
    }
}
