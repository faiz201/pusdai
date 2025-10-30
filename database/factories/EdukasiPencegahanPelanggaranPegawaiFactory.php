<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EdukasiPencegahanPelanggaranPegawai>
 */
class EdukasiPencegahanPelanggaranPegawaiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'periode' => $this->faker->randomElement([
                'Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV'
            ]),
            'satker_id' => Satker::factory(), // relasi otomatis ke Satker

            'jenis_kegiatan' => $this->faker->randomElement([
                'Workshop', 'Seminar', 'Pelatihan', 'FGD', 'Sosialisasi Internal'
            ]),
            'tema' => $this->faker->sentence(5),
            'waktu' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'tempat' => $this->faker->randomElement([
                'Ruang Rapat', 'Aula Kantor', 'Gedung Pelatihan', 'Online via Zoom'
            ]),
            'narasumber' => $this->faker->name(),
            'jumlah_peserta' => $this->faker->numberBetween(10, 150),
            'sasaran' => $this->faker->randomElement([
                'Pegawai', 'Pejabat Struktural', 'Tenaga Honorer', 'Mahasiswa Magang'
            ]),
            'indeks_efektivitas' => $this->faker->randomElement([
                'Sangat Baik', 'Baik', 'Cukup', 'Kurang'
            ]),
            'keterangan' => $this->faker->sentence(10),

            'created_at' => now()->subDays(rand(0, 60)),
            'updated_at' => now(),
        ];
    }
}
