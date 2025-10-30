<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembinaanMental>
 */
class PembinaanMentalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'periode' => $this->faker->randomElement([
                'Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV'
            ]),
            'satker_id' => Satker::factory(), // relasi otomatis ke Satker
            'indeks_pelaksanaan_dalam_setahun' => $this->faker->numberBetween(1, 5),
            'indeks_peserta_kegiatan' => $this->faker->numberBetween(1, 5),
            'output_project_learning' => $this->faker->numberBetween(1, 5),
            'indeks_total' => function (array $attributes) {
                return round(
                    ($attributes['indeks_pelaksanaan_dalam_setahun']
                    + $attributes['indeks_peserta_kegiatan']
                    + $attributes['output_project_learning']) / 3,
                    2
                );
            },
            'kesimpulan' => $this->faker->randomElement(['Baik', 'Cukup', 'Kurang']),
            'created_at' => now()->subDays(rand(0, 90)),
            'updated_at' => now(),
        ];
    }
}
