<?php

namespace App\Exports;

use App\Models\EdukasiPencegahanPelanggaranPegawai;
use Maatwebsite\Excel\Concerns\FromCollection;

class EdukasiRencanaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EdukasiPencegahanPelanggaranPegawai::with('satker')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'periode' => $item->periode,
                    'jenis_kegiatan' => '-',
                    'waktu' => '-',
                    'tema' => '-',
                    'tempat' => '-',
                    'narasumber' => '-',
                    'jumlah_peserta' => '-',
                    'sasaran' => '-',
                    'indeks_efektivitas' => '-',
                    'keterangan' => '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'no',
            'periode',
            'jenis_kegiatan',
            'waktu',
            'tema',
            'tempat',
            'narasumber',
            'jumlah_peserta',
            'sasaran',
            'indeks_efektivitas',
            'keterangan',
        ];
    }
}
