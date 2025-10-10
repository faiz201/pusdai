<?php

namespace App\Services;

use App\Models\Satker;

class SatkerService
{
    public function getAll()
    {
        return Satker::all();
    }

    public function getFiltered($tahun = null, $bulan =null, $satker = null)
    {
        $query = Satker::query();

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($satker) {
            $query->where('nama satker', 'like', "%$satker%");
        }

        return $query->get();
    }
    public function getById($id)
    {
        return Satker::findOrFail($id);
    }

    /**
     * Data untuk export Excel/CSV
     */
    public function getForExport($tahun = null, $bulan = null, $satker = null)
    {
        return $this->getFiltered($tahun, $bulan,$satker);
    }
}
