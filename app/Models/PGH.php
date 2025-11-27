<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PGH extends Model
{
    use HasFactory;

    protected $table = 'pgh';

    protected $fillable = [
        'satker_id',
        'dasar_pelaksanaan',
        'objek_pemantauan',
        'jenis_dugaan',
        'penyelesaian',
        'status_terbukti',
        'laporan_hasil',
        'dasar_rekomendasi',
        'jenis_rekomendasi',
        'status_tindak_lanjut',
        'dasar_tindak_lanjut',
        'keterangan',
        'indeks_pelaksanaan_dalam_setahun',
        'indeks_peserta_kegiatan',
        'output_project_learning',
        'indeks_total',
        'kesimpulan'
    ];

    // 🔥 Hitungan otomatis (tanpa simpan ke DB)
    public function getIndeksTotalAttribute()
    {
        return
            ($this->indeks_pelaksanaan_dalam_setahun ?? 0) +
            ($this->indeks_peserta_kegiatan ?? 0) +
            ($this->output_project_learning ?? 0);
    }

    // 🔥 Kesimpulan otomatis (tidak disimpan)
    public function getKesimpulanAttribute($value)
    {
        $total = $this->indeks_total;

        return match (true) {
            $total < 3 => 'Belum Memadai',
            $total < 5 => 'Kurang',
            $total < 7 => 'Baik',
            default => 'Sangat Baik',
        };
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
}
