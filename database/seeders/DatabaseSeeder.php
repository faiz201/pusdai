<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Monitoring; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         // Jalankan seeder input laporan
        $this->call([
            UserSeeder::class,
            MonitoringSeeder::class,
            InputLaporanSeeder::class,
        ]);
    }
}
