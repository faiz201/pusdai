<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Satker,
    PembinaanMental,
    SosialisasiAntikorupsi,
    EdukasiPencegahanPelanggaranPegawai,
    PenangananLaporanGratifikasi,
    PGH,
    Pemantauan
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan seeder lain jika diperlukan
        $this->call([
            UserSeeder::class,
            MonitoringSeeder::class,
            InputLaporanSeeder::class,
        ]);

        // Ambil semua satker yang sudah ada di database
        $satker = Satker::all();

        if ($satker->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada data Satker di database. Tambahkan dulu data Satker sebelum menjalankan seeder ini.');
            return;
        }

        // Loop setiap satker untuk membuat data terkait
        foreach ($satker as $m) {

            PembinaanMental::factory(rand(2, 5))->create([
                'satker_id' => $m->id,
            ]);

            SosialisasiAntikorupsi::factory(rand(1, 3))->create([
                'satker_id' => $m->id,
            ]);

            EdukasiPencegahanPelanggaranPegawai::factory(rand(1, 3))->create([
                'satker_id' => $m->id,
            ]);

            PenangananLaporanGratifikasi::factory(rand(1, 3))->create([
                'satker_id' => $m->id,
            ]);

            PGH::factory(rand(1, 3))->create([
                'satker_id' => $m->id,
            ]);

            Pemantauan::factory(rand(1, 2))->create([
                'satker_id' => $m->id,
            ]);
        }

        $this->command->info('✅ Database seeding selesai! Semua tabel terisi otomatis dan terhubung ke Satker yang sudah ada.');
    }
}
