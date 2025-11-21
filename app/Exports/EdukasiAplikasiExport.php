<?php

namespace App\Exports;

use App\Models\EdukasiPencegahanPelanggaranPegawai;
use Maatwebsite\Excel\Concerns\FromCollection;

class EdukasiAplikasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EdukasiPencegahanPelanggaranPegawai::with('satker')
            ->orderBy('created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'periode' => $item->periode,
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
            'periode',
            'indeks_pelaksanaan_setahun',
            'indeks_peserta_kegiatan',
            'output_project_learning',
            'indeks_total',
            'kesimpulan',
        ];
    }
}
