<?php

namespace Database\Factories;

use App\Models\InputLaporan;
use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InputLaporanFactory extends Factory
{
    protected $model = InputLaporan::class;

    public function definition(): array
    {
        // Pastikan Monitoring & User tersedia
        $monitoring = Monitoring::inRandomOrder()->first() ?? Monitoring::factory()->create();
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'seksi' => $monitoring->id,
            'user_id' => $user->id,
            'judul_laporan' => 'Laporan Uji Coba' . $this->faker->unique()->numberBetween(1, 1000),
            'detail' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['draft', 'submitted',]),
        ];
    }
}
