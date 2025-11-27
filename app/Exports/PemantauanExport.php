<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PemantauanExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Rencana'  => new PemantauanRencanaExport(),
            'Kertas Aplikasi' => new PemantauanAplikasiExport(),
        ];
    }
}
