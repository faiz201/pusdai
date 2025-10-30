<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemantauan>
 */
class PemantauanFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Relasi otomatis ke tabel Satker
            'satker_id' => Satker::factory(),

            // Kolom sesuai migrasi
            'tahun_predikat' => $this->faker->randomElement(['2021', '2022', '2023', '2024', '2025']),
            'pemeliharaan_wbk' => $this->faker->boolean(70), // 70% true
            'pencanangan_wbbm' => $this->faker->boolean(50), // 50% true
            'proses_penilaian_wbbm' => $this->faker->boolean(40), // 40% true
            'predikat_wbbm' => $this->faker->randomElement([
                'Belum Mendapat Predikat',
                'Dalam Proses',
                'Menuju WBBM',
                'WBBM',
                'WBK'
            ]),

            'created_at' => now()->subDays(rand(0, 180)),
            'updated_at' => now(),
        ];
    }
}
