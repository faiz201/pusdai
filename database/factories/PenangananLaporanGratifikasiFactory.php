<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Satker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenangananLaporanGratifikasi>
 */
class PenangananLaporanGratifikasiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'satker_id' => Satker::factory(), // relasi otomatis ke Satker

            'nomor_sig' => strtoupper('SIG-' . $this->faker->bothify('####/GRTF/##/2025')),
            'jenis' => $this->faker->randomElement([
                'Penerimaan Gratifikasi', 
                'Penolakan Gratifikasi', 
                'Pelaporan Gratifikasi'
            ]),
            'bentuk_pemberian' => $this->faker->randomElement([
                'Uang', 'Barang', 'Fasilitas', 'Perjalanan Dinas', 'Lainnya'
            ]),
            'objek_penanganan' => $this->faker->sentence(3),
            'nilai_taksiran' => $this->faker->randomFloat(2, 100000, 50000000),
            'kategori_pemberi' => $this->faker->randomElement([
                'Rekanan', 'Pihak Ketiga', 'Masyarakat Umum', 'Internal Instansi'
            ]),
            'proses_bisnis' => $this->faker->randomElement([
                'Pengadaan Barang/Jasa', 
                'Perizinan', 
                'Pemberian Layanan Publik', 
                'Kerjasama Instansi'
            ]),
            'status_kpk' => $this->faker->randomElement([
                'Diterima KPK', 
                'Dalam Proses', 
                'Dikembalikan ke Instansi', 
                'Ditolak'
            ]),
            'nomor_sk' => strtoupper('SK-' . $this->faker->bothify('###/KPK/##/2025')),
            'tindak_lanjut' => $this->faker->randomElement([
                'Diserahkan ke KPK', 
                'Dikembalikan kepada penerima', 
                'Dimusnahkan', 
                'Masih dalam evaluasi'
            ]),
            'keterangan' => $this->faker->sentence(10),

            'created_at' => now()->subDays(rand(0, 60)),
            'updated_at' => now(),
        ];
    }
}
