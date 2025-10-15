<?php  
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialisasiAntikorupsi extends Model
{
    use HasFactory;

    protected $table = 'sosialisasi_antikorupsi';

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
