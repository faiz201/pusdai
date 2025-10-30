<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Satker,
    PembinaanMental,
    SosialisasiAntikorupsi,
    EdukasiPencegahanPelanggaranPegawai,
    PenangananLaporanGratifikasi,
    PGH,
    Pemantauan
};

class SatkerFactory extends Factory
{
    protected $model = Satker::class;

    public function definition()
    {
        return [
            'nama_satker' => $this->faker->unique()->company(),
            'total_nilai' => 0,
            'created_at' => now()->subDays(rand(0, 300)),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Satker $satker) {
            // Buat relasi per satker
            $pembinaan     = PembinaanMental::factory(3)->create(['satker_id' => $satker->id]);
            $sosialisasi   = SosialisasiAntikorupsi::factory(3)->create(['satker_id' => $satker->id]);
            $edukasi       = EdukasiPencegahanPelanggaranPegawai::factory(3)->create(['satker_id' => $satker->id]);
            $gratifikasi   = PenangananLaporanGratifikasi::factory(3)->create(['satker_id' => $satker->id]);
            $pgh           = PGH::factory(3)->create(['satker_id' => $satker->id]);
            $pemantauan    = Pemantauan::factory(3)->create(['satker_id' => $satker->id]);

            // Hitung total nilai rata-rata dari semua relasi
            $totalNilai = collect([
                $pembinaan->avg('nilai'),
                $sosialisasi->avg('nilai'),
                $edukasi->avg('nilai'),
                $gratifikasi->avg('nilai'),
                $pgh->avg('nilai'),
                $pemantauan->avg('nilai'),
            ])->avg();

            $satker->update(['total_nilai' => round($totalNilai * 50, 2)]); // konversi ke skala 0–100
        });
    }
}
