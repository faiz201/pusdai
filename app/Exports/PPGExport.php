<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PPGExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana'  => new PPGRencanaExport(),
            'Kertas Aplikasi' => new PPGAplikasiExport(),
        ];
    }
}
