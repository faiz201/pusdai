<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PembinaanMentalMultiSheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana & Realisasi' => new PembinaanRencanaExport(),   // sheet pertama
            'Kertas Aplikasi'     => new PembinaanAplikasiExport(),  // sheet kedua
        ];
    }
}
