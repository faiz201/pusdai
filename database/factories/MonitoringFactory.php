<?php

namespace Database\Factories;

use App\Models\Monitoring;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonitoringFactory extends Factory
{
    protected $model = Monitoring::class;

    public function definition(): array
    {
        return [
            'seksi' => 'Seksi ' . $this->faker->numberBetween(1, 10),
            'kegiatan' => $this->faker->sentence(8),
            'status' => $this->faker->randomElement(['selesai', 'belom selesai']),
        ];
    }
}