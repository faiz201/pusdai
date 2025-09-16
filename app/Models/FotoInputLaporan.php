<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoInputLaporan extends Model
{
    use HasFactory;

    protected $table = 'foto_input_laporans';

    protected $fillable = [
        'input_laporan_id',
        'foto',
    ];

    /** Relasi ke Input Laporan */
    public function inputLaporan()
    {
        return $this->belongsTo(InputLaporan::class);
    }
}