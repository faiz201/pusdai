<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputLaporan extends Model
{
    use HasFactory;

    protected $table = 'input_laporan';

    protected $fillable = [
        'monitoring_id',
        'user_id',
        'judul_laporan',
        'detail',
        'status',
        'foto',
    ];

    /** Relasi ke Monitoring */
    public function monitoring()
    {
        return $this->belongsTo(Monitoring::class, 'monitoring_id');
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
