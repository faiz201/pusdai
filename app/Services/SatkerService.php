<?php

namespace App\Services;

use App\Models\Satker;

class SatkerService
{
    public function getAll()
    {
        return Satker::all();
    }

    public function getFiltered($tahun = null, $bulan =null, $unit = null)
    {
        $query = Satker::query();

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereYear('created_at', $bulan);
        }

        if ($unit) {
            $query->where('nama_satker', 'like', "%$unit%");
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
    public function getForExport($tahun = null, $bulan = null, $unit = null)
    {
        return $this->getFiltered($tahun, $bulan,$unit);
    }
}
