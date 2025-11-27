<?php

namespace App\Exports;

use App\Models\Pemantauan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemantauanRencanaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pemantauan::with('satker')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'tahun_predikat' => '-',
                    'pemeliharaan_wbk' => '-',
                    'pencanangan_wbbm' => '-',
                    'penilaian_wbbm' => '-',
                    'predikat_wbbm' => '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'no',
            'tahun_predikat',
            'pemeliharaan_wbk',
            'pencanangan_wbbm',
            'penilaian_wbbm',
            'predikat_wbbm',
        ];
    }
}
