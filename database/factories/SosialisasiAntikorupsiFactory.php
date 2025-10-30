<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SosialisasiAntikorupsi>
 */
class SosialisasiAntikorupsiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'periode' => $this->faker->randomElement([
                'Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV'
            ]),
            'satker_id' => Satker::factory(), // relasi otomatis ke Satker

            'jenis_kegiatan' => $this->faker->randomElement([
                'Seminar', 'Workshop', 'Pelatihan', 'Webinar', 'FGD'
            ]),
            'tema' => $this->faker->sentence(5),
            'waktu' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'tempat' => $this->faker->randomElement([
                'Aula Kantor', 'Ruang Rapat', 'Gedung Serbaguna', 'Online via Zoom'
            ]),
            'narasumber' => $this->faker->name(),
            'jumlah_peserta' => $this->faker->numberBetween(10, 200),
            'sasaran' => $this->faker->randomElement([
                'Pegawai', 'Mahasiswa', 'Masyarakat Umum', 'Pelajar'
            ]),
            'indeks_efektivitas' => $this->faker->randomElement([
                'Sangat Baik', 'Baik', 'Cukup', 'Kurang'
            ]),
            'keterangan' => $this->faker->sentence(10),
            'created_at' => now()->subDays(rand(0, 90)),
            'updated_at' => now(),
        ];
    }
}
