<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanMental extends Model
{
    use HasFactory;

    protected $table = 'pembinaan_mental'; 

    protected $fillable = [
        'periode',
        'satker_id',
        'indeks_pelaksanaan_dalam_setahun',
        'indeks_peserta_kegiatan',
        'output_project_learning',
        'indeks_total',
        'kesimpulan'
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            $pelaksanaan = $model->indeks_pelaksanaan_dalam_setahun ?? 0;
            $peserta = $model->indeks_peserta_kegiatan ?? 0;
            $output = $model->output_project_learning ?? 0;

            $total = $pelaksanaan + $peserta + $output;

            $model->indeks_total = $total;
            $model->kesimpulan = match (true) {
                $total < 3 => 'Belum Memadai',
                $total < 5 => 'Kurang',
                $total < 7 => 'Baik',
                default => 'Sangat Baik',
            };
        });
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
}
