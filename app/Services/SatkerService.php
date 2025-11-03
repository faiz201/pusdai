<?php

namespace App\Services;

use App\Models\Satker;
use App\Models\PembinaanMental;
use App\Models\SosialisasiAntikorupsi;
use App\Models\EdukasiPencegahanPelanggaranPegawai;
use App\Models\PenangananLaporanGratifikasi;
use App\Models\PGH;
use App\Models\Pemantauan;

class SatkerService
{
    public function getAll()
    {
        return Satker::all();
    }

    private function skor($kesimpulan)
    {
        return match (strtolower($kesimpulan ?? '-')) {
            'sangat baik' => 10,
            'baik' => 8,
            'cukup' => 5,
            'kurang' => 2,
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
                'pelaksanaan_monev_zi' => Pemantauan::class,
            ];

            $hasil = [];
            $totalNilai = 0;
            $jumlahAspek = count($tabels);

            foreach ($tabels as $key => $model) {
                $record = $model::where('satker_id', $item->id)
                    ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
                    ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
                    ->latest()->first();

                if ($record) {
                    $nilai = $record->nilai ?? null;
                    $kesimpulan = $record->kesimpulan ?? null;

                    if (is_numeric($nilai)) {
                        $hasil[$key] = $nilai;
                        $totalNilai += $nilai;
                    } else {
                        $hasil[$key] = $kesimpulan ?? '-';
                        $totalNilai += $this->skor($kesimpulan);
                    }
                } else {
                    $hasil[$key] = '-';
                }
            }

            $rata2 = $jumlahAspek ? round($totalNilai / $jumlahAspek, 2) : 0;

            $simpulan = match (true) {
                $rata2 >= 90 => 'Sangat Baik',
                $rata2 >= 75 => 'Baik',
                $rata2 >= 60 => 'Cukup',
                default => 'Kurang',
            };

            return [
                'id' => $item->id,
                'nama_satker' => $item->nama_satker,
                ...$hasil,
                'total_nilai' => $rata2,
                'simpulan_performa_pencegahan' => $simpulan,
            ];
        });

        return $data;
    }

    public function getById($id)
    {
        return Satker::findOrFail($id);
    }

    public function getForExport($tahun = null, $bulan = null, $satker = null)
    {
        return $this->getFiltered($tahun, $bulan, $satker);
    }
}
