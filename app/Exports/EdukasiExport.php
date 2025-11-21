<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EdukasiExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana'  => new EdukasiRencanaExport(),
            'Kertas Aplikasi' => new EdukasiAplikasiExport(),
        ];
    }
}
