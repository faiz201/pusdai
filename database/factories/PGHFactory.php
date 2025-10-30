<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pgh>
 */
class PghFactory extends Factory
{
    public function definition(): array
    {
        return [
            'satker_id' => Satker::factory(), // relasi otomatis ke Satker

            'dasar_pelaksanaan' => $this->faker->sentence(4),
            'objek_pemantauan' => $this->faker->randomElement([
                'Kedisiplinan Pegawai', 
                'Kepatuhan Aturan', 
                'Pengendalian Gratifikasi', 
                'Integritas Layanan Publik'
            ]),
            'jenis_dugaan' => $this->faker->randomElement([
                'Pelanggaran Kode Etik', 
                'Penyalahgunaan Wewenang', 
                'Ketidakpatuhan Prosedur', 
                'Indikasi Gratifikasi'
            ]),
            'penyelesaian' => $this->faker->randomElement([
                'Pembinaan', 
                'Rekomendasi Etik', 
                'Proses Hukum', 
                'Tidak Ditemukan Pelanggaran'
            ]),
            'status_terbukti' => $this->faker->randomElement([
                'Terbukti', 
                'Tidak Terbukti', 
                'Masih Diselidiki'
            ]),
            'laporan_hasil' => $this->faker->randomElement([
                'Laporan Hasil Pemeriksaan', 
                'Laporan Evaluasi', 
                'Laporan Klarifikasi'
            ]),
            'dasar_rekomendasi' => $this->faker->sentence(3),
            'jenis_rekomendasi' => $this->faker->randomElement([
                'Tindakan Administratif', 
                'Rekomendasi Perbaikan Proses', 
                'Sanksi Disiplin', 
                'Edukasi Pegawai'
            ]),
            'status_tindak_lanjut' => $this->faker->randomElement([
                'Sudah Ditindaklanjuti', 
                'Dalam Proses', 
                'Belum Ditindaklanjuti'
            ]),
            'dasar_tindak_lanjut' => $this->faker->sentence(3),
            'keterangan' => $this->faker->paragraph(),

            'created_at' => now()->subDays(rand(0, 60)),
            'updated_at' => now(),
        ];
    }
}
