<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

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
