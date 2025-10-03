<?php

namespace App\Exports;

use App\Services\SatkerService;
use App\Models\Dashboard;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SatkerExport implements FromCollection, WithHeadings
{
    protected $tahun;
    protected $bulan;
    protected $unit;
    protected $satkerService;

    public function __construct($tahun = null, $bulan = null, $unit = null)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
        $this->unit  = $unit;
        $this->satkerService = new SatkerService();
    }

    public function collection()
    {
        return $this->satkerService->getForExport($this->tahun, $this->bulan,$this->unit);
    }

    public function map($m): array
    {
        return [
            $m->id,
            $m->satuan_kerja,
            $m->konteks,
            $m->pembinaan_mental,
            $m->sosialisasi_antikorupsi,
            $m->edukasi_pencegahan,
            $m->pengendalian_gratifikasi,
            $m->pemantauan_perilaku,
            $m->pemantauan_lhk,
            $m->pelaksanaan_monev_zi,
            $m->analisis_data_pegawai,
            $m->penanganan_hasil_survey,
            $m->penanganan_pengaduan,
            $m->total_skor,
            $m->kategori,
        ];
    }
    public function headings(): array
    {
        return [
            'ID',
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
            'Created At',
            'Updated At',
        ];
    }
}
