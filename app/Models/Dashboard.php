<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'satuan_kerja',
        'konteks',
        'pembinaan_mental',
        'sosialisasi_antikorupsi',
        'edukasi_pencegahan',
        'pengendalian_gratifikasi',
        'pemantauan_perilaku',
        'pemantauan_lhk',
        'pelaksanaan_monev_zi',
        'analisis_data_pegawai',
        'penanganan_hasil_survey',
        'penanganan_pengaduan',
    ];

    // Hitung total skor
    public function getTotalSkorAttribute()
    {
        return $this->pembinaan_mental
            + $this->sosialisasi_antikorupsi
            + $this->edukasi_pencegahan
            + $this->pengendalian_gratifikasi
            + $this->pemantauan_perilaku
            + $this->pemantauan_lhk
            + $this->pelaksanaan_monev_zi
            + $this->analisis_data_pegawai
            + $this->penanganan_hasil_survey
            + $this->penanganan_pengaduan;
    }

    // Hitung kategori performa
    public function getKategoriAttribute()
    {
        $total = $this->total_skor;

        if ($total < 10) return 'Belum Memadai';
        if ($total <= 20) return 'Cukup';
        if ($total <= 30) return 'Baik';
        return 'Sangat Baik';
    }
}
