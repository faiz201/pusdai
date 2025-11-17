<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PembinaanMentalExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana & Realisasi' => new PembinaanRencanaExport(),
            'Kertas Aplikasi' => new PembinaanAplikasiExport(),
        ];
    }
}
