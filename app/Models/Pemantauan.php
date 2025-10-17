<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemantauan extends Model
{
    use HasFactory;

    protected $table = 'pemantauan_zona_integritas';

    protected $fillable = [
        'satker_id',
        'tahun_predikat',
        'pemeliharaan_wbk',
        'pencanangan_wbbm',
        'penilaian_wbbm',
        'predikat_wbbm',
    ];

    // Relasi ke Satker
    public function satker()
    {
        return $this->belongsTo(Satker::class);
    }

    // Getter indeks (otomatis 1 kalau "Ya", 0 kalau "Tidak")
    public function getIndeks($field)
    {
        return $this->{$field} === 'Ya' ? 1 : 0;
    }
}
