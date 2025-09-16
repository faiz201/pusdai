<?php

namespace Database\Seeders;

use App\Models\Monitoring;
use App\Models\User;
use App\Models\InputLaporan;
use Illuminate\Database\Seeder;

class InputLaporanSeeder extends Seeder
{
    public function run(): void
    {
        $monitoring = Monitoring::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        InputLaporan::create([
            'seksi' => $monitoring->id, // ✅ ambil dari monitoring yang ada
            'user_id' => $user->id ?? 1,        // fallback ke 1 kalau belum ada user
            'judul_laporan' => 'Laporan Uji Coba',
            'detail' => 'Detail laporan dummy data.',
            'status' => 'draft',
        ]);
    }
}