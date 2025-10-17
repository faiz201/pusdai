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
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
}
