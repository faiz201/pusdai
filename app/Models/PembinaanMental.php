<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanMental extends Model
{
    use HasFactory;

    protected $table = 'pembinaan_mental'; 

    protected $fillable = [
        'nama satker',
        'periode',
        'indeks_pelaksanaan_dalam_setahun',
        'indeks_peserta_kegiatan',
        'output_project_learning',
        'indeks_total',
        'kesimpulan'
    ];

    protected $appends = ['indeks_total', 'kesimpulan'];
    
    public function getIndeksTotalAttribute()
    {
        return $this->pelaksanaan + $this->peserta + $this->output;
    }
    
    public function getKesimpulanAttribute()
    {
        $total = $this->indeks_total;
        
        if ($total < 3) return 'Belum Memadai';
        if ($total <=3) return 'Kurang';
        if ($total <= 6) return 'Baik';
        if ($total <= 7) return 'Sangat Baik';
    }
    public function satker()
    {
        return $this->belongsTo(Satker::class, 'nama satker');
    }
}
