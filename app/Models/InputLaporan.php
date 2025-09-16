<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputLaporan extends Model
{
    use HasFactory;

    protected $table = 'input_laporan';

    protected $fillable = [
        'seksi',
        'user_id',
        'judul_laporan',
        'detail',
        'status',
    ];

    /** Relasi ke Monitoring */
    public function monitoring()
    {
        return $this->belongsTo(Monitoring::class);
    }

    /** Relasi ke User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi ke Foto Input Laporan */
    public function fotoInputLaporan()
    {
        return $this->hasMany(FotoInputLaporan::class);
    }
}