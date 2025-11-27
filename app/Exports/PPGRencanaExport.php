<?php

namespace App\Exports;

use App\Models\PenangananLaporanGratifikasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class PPGRencanaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PenangananLaporanGratifikasi::with('satker')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'nomor_sig' => '-',
                    'jenis' => '-',
                    'bentuk_pemberian' => '-',
                    'objek_penanganan' => '-',
                    'nilai_taksiran' => '-',
                    'kategori_pemberi' => '-',
                    'proses_bisnis' => '-',
                    'status_kpk' => '-',
                    'nomor_sk' => '-',
                    'tindak_lanjut' => '-',
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
            'bentuk_pemberian',
            'objek_penanganan',
            'nilai_taksiran',
            'kategori_pemberi',
            'proses_bisnis',
            'status_kpk',
            'nomor_sk',
            'tindak_lanjut',
            'keterangan'
        ];
    }
}
