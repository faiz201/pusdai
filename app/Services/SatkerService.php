<?php

namespace App\Services;

use App\Models\Satker;
use App\Models\PembinaanMental;
use App\Models\SosialisasiAntikorupsi;
use App\Models\EdukasiPencegahanPelanggaranPegawai;
use App\Models\PenangananLaporanGratifikasi;
use App\Models\PGH;

class SatkerService
{
    public function getAll()
    {
        return Satker::all();
    }

    private function skor($kesimpulan)
    {
        return match (strtolower($kesimpulan ?? '-')) {
            'baik' => 5,
            'cukup' => 3,
            'kurang' => 1,
            default => 0,
        };
    }


    public function getFiltered($tahun = null, $bulan = null, $satker = null)
    {
        $query = Satker::query();

        if ($satker) {
            $query->where('nama_satker', 'like', "%$satker%");
        }

        $data = $query->get()->map(function ($item) use ($tahun, $bulan) {

            $tabels = [
                'pembinaan_mental' => PembinaanMental::class,
                'sosialisasi_antikorupsi' => SosialisasiAntikorupsi::class,
                'edukasi_pencegahan_pelanggaran_pegawai' => EdukasiPencegahanPelanggaranPegawai::class,
                'penanganan_laporan_gratifikasi' => PenangananLaporanGratifikasi::class,
                'pemantauan_perilaku_gaya_hidup_pegawai' => PGH::class,
            ];

            $hasil = [];
            $totalNilai = 0;

            foreach ($tabels as $key => $model) {
                $record = $model::where('satker_id', $item->id)
                    ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
                    ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
                    ->latest()->first();

                $kesimpulan = $record->kesimpulan ?? '-';
                $hasil[$key] = $kesimpulan;

                // tambahkan ke total skor
                $totalNilai += $this->skor($kesimpulan);
            }

            // Buat simpulan akhir otomatis
            $simpulan =
                $totalNilai >= 40 ? 'Sangat Baik' :
                ($totalNilai >= 30 ? 'Baik' :
                ($totalNilai >= 15 ? 'Cukup' : 'Kurang'));

            return [
                'id' => $item->id,
                'nama_satker' => $item->nama_satker,
                ...$hasil,
                'total_nilai' => $totalNilai,
                'simpulan_performa_pencegahan' => $simpulan,
            ];
        });

        return $data;
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
