<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdukasiPencegahanPelanggaranPegawai extends Model
{
    use HasFactory;

    protected $table = 'edukasi_pencegahan_pelanggaran_pegawai';

    protected $fillable = [
        'periode',
        'satker_id',
        'jenis_kegiatan',
        'tema',
        'waktu',
        'tempat',
        'narasumber',
        'jumlah_peserta',
        'sasaran',
        'indeks_efektivitas',
        'keterangan',
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
}
