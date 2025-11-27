<?php

namespace App\Exports;

use App\Models\PGH;
use Maatwebsite\Excel\Concerns\FromCollection;

class PGHRencanaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PGH::with('satker')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'dasar_pelaksanaan' => '-',
                    'objek_pemantauan' => '-',
                    'jenis_dugaan' => '-',
                    'penyelesaian' => '-',
                    'status_terbukti' => '-',
                    'laporan_hasil' => '-',
                    'dasar_rekomendasi' => '-',
                    'jenis_rekomendasi' => '-',
                    'status_tindak_lanjut' => '-',
                    'dasar_tindak_lanjut' => '-',
                    'keterangan' => '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'no',
            'dasar_pelaksanan',
            'objenk_pemantauan',
            'jenis_dugaan',
            'penyelesaian',
            'status_terbukti',
            'laporan_hasil',
            'dasar_rekomendasi',
            'jenis_rekomendasi',
            'status_tindak_lanjut',
            'dasar_tindak_lanjut',
            'keterangan'
        ];
    }
}
