<?php

namespace Database\Seeders;

use App\Models\InputLaporan;
use Illuminate\Database\Seeder;

class InputLaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 148 data dengan factory
        InputLaporan::factory(147)->create();
    }
}
