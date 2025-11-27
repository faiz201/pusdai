<?php

namespace App\Exports;

use App\Models\Pemantauan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemantauanAplikasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pemantauan::with('satker')
            ->orderBy('created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'indeks_pelaksanaan_setahun' => $item->indeks_pelaksanaan_dalam_setahun,
                    'indeks_peserta_kegiatan' => $item->indeks_peserta_kegiatan,
                    'output_project_learning' => $item->output_project_learning,
                    'indeks_total' => $item->indeks_total,
                    'kesimpulan' => $item->kesimpulan,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'indeks_pelaksanaan_setahun',
            'indeks_peserta_kegiatan',
            'output_project_learning',
            'indeks_total',
            'kesimpulan',
        ];
    }
}
