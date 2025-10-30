<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    InputLaporan,
    Satker,
    PembinaanMental,
    SosialisasiAntikorupsi,
    EdukasiPencegahanPelanggaranPegawai,
    PenangananLaporanGratifikasi,
    PGH,
    Pemantauan,
};

class InputLaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 data dengan factory
        InputLaporan::factory(10)->create();

        $satker = Satker::all();

        foreach ($satker as $m) {
            PembinaanMental::factory()->create(['satker_id' => $m->id]);
            SosialisasiAntikorupsi::factory()->create(['satker_id' => $m->id]);
            EdukasiPencegahanPelanggaranPegawai::factory()->create(['satker_id' => $m->id]);
            PenangananLaporanGratifikasi::factory()->create(['satker_id' => $m->id]);
            PGH::factory()->create(['satker_id' => $m->id]);
            Pemantauan::factory()->create(['satker_id' => $m->id]);
        }
    }
}
