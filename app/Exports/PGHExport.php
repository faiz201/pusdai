<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PGHExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana'  => new PGHRencanaExport(),
            'Kertas Aplikasi' => new PGHAplikasiExport(),
        ];
    }
}
