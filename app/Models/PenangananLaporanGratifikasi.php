<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenangananLaporanGratifikasi extends Model
{
    use HasFactory;

    protected $table = 'penanganan_laporan_gratifikasi';

    protected $fillable = [
        'satker_id',
        'nomor_sig',
        'jenis',
        'bentuk_pemberian',
        'objek_penanganan',
        'nilai_taksiran',
        'kategori_pemberi',
        'proses_bisnis',
        'status_kpk',
        'nomor_sk',
        'tindak_lanjut',
        'keterangan',
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
}
