<?php

namespace Database\Seeders;

use App\Models\InputLaporan;
use Illuminate\Database\Seeder;

class InputLaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 data dengan factory
        InputLaporan::factory(10)->create();
    }
}
