<?php

namespace App\Exports;

use App\Models\PembinaanMental;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembinaanMentalExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return PembinaanMental::with('satker')
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Satker' => $item->satker->nama_satker ?? '-',
                    'Periode' => $item->periode ?? '-',
                    'Indeks Pelaksanaan Dalam Setahun' => $item->indeks_pelaksanaan_dalam_setahun ?? '-',
                    'Indeks Peserta Kegiatan' => $item->indeks_peserta_kegiatan ?? '-',
                    'Output Project Learning' => $item->output_project_learning ?? '-',
                    'Indeks Total' => $item->indeks_total ?? '-',
                    'Kesimpulan' => $item->kesimpulan ?? '-',
                    'Dibuat Pada' => $item->created_at ? $item->created_at->format('d-m-Y') : '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Satker',
            'Periode',
            'Indeks Pelaksanaan Dalam Setahun',
            'Indeks Peserta Kegiatan',
            'Output Project Learning',
            'Indeks Total',
            'Kesimpulan',
            'Dibuat Pada',
        ];
    }
}