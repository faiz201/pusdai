<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SosialisasiAntikorupsiExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana'  => new SosialisasiRencanaExport(),
            'Kertas Aplikasi' => new SosialisasiAplikasiExport(),
        ];
    }
}
