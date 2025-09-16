<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Monitoring;

class MonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Monitoring::create([
            'seksi' => 'Seksi 1',
            'kegiatan' => 'Deskripsi kegiatan ke-1 sebagai dummy data',
            'status' => 'selesai',
        ]);

        // generate 10 data dummy otomatis
        Monitoring::factory()->count(9)->create();
    }
}