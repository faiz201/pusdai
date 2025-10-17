<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SatkerService;
use App\Exports\SatkerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Satker;
use App\Models\PembinaanMental;
use App\Models\SosialisasiAntikorupsi;
use App\Models\EdukasiPencegahanPelanggaranPegawai;
use App\Models\PenangananLaporanGratifikasi;
use App\Models\PGH;

class DashboardController extends Controller
{
    protected $satkerService;
    
    public function __construct(SatkerService $satkerService)
    {
        $this->satkerService = $satkerService;
    }

    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $unit  = $request->input('unit');

        // Ambil semua data satker beserta hasil rekap performa lengkap
        $satker = $this->satkerService->getFiltered($tahun, $bulan, $unit);

        $top10 = $satker->sortByDesc('total_nilai')->take(10);
        $bottom10 = $satker->sortBy('total_nilai')->take(10);

        return view('backend.v_dashboard.index', compact('satker', 'tahun', 'bulan', 'unit', 'top10', 'bottom10'));
    }

    public function filter(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $unit  = $request->input('unit');

        $satker = $this->satkerService->getFiltered($tahun, $bulan, $unit);

        $summary = [
            'total_satker' => $satker->count(),
            'rata_nilai'   => round($satker->avg('total_nilai'), 2),
            'nilai_max'    => $satker->max('total_nilai'),
            'nilai_min'    => $satker->min('total_nilai'),
        ];

        $top10 = $satker->sortByDesc('total_nilai')->take(10)->values();
        $bottom10 = $satker->sortBy('total_nilai')->take(10)->values();

        return response()->json([
            'summary' => $summary,
            'top10' => $top10,
            'bottom10' => $bottom10
        ]);
    }

    public function getDetail($id)
    {
        $satker = Satker::findOrFail($id);

        // simulasi data performa bidang (nanti bisa diambil dari tabel-tabel lain)
        return response()->json([
            'id' => $satker->id,
            'nama_satker' => $satker->nama_satker,
            'total_nilai' => rand(50, 100),
            'kesimpulan' => 'Baik',
            'bidang' => [
                'Pembinaan Mental' => rand(50, 100),
                'Sosialisasi Antikorupsi' => rand(50, 100),
                'Gratifikasi' => rand(50, 100),
                'Zona Integritas' => rand(50, 100),
                'LHK' => rand(50, 100)
            ]
        ]);
    }

    public function show($id)
    {
        $satker = Satker::findOrFail($id);

        // Ambil data tiap bidang (pastikan tabel & kolom sesuai struktur kamu)
        $mental = PembinaanMental::where('satker_id', $satker->id)->latest()->first();
        $sosialisasi = SosialisasiAntikorupsi::where('satker_id',$satker->id)->latest()->first();
        $edukasi = EdukasiPencegahanPelanggaranPegawai::where('satker_id',$satker->id)->latest()->first();
        $gratifikasi = PenangananLaporanGratifikasi::where('satker_id', $satker->id)->latest()->first();
        $pemantauan = PGH::where('satker_id',$satker->id)->latest()->first();

        // Buat dataset nilai per bidang
        $nilai = [
            'Mental' => $mental->total_nilai,
            'Sosialisasi' => $sosialisasi->total_nilai,
            'Edukasi' => $edukasi->total_nilai,
            'Gratifikasi' => $gratifikasi->total_nilai,
            'Pemantauan' => $pemantauan->total_nilai,
        ];

        return response()->json([
            'nama_satker' => $satker->nama_satker,
            'total_nilai' => $satker->total_nilai,
            'kesimpulan' => $mental->kesimpulan ?? '-',
            'bidang' => $nilai,
        ]);
    }

     public function exportExcel(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun,$request->bulan,$request->satker),
            'satker.xlsx'
        );
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun,$request->bulan,$request->satker),
            'satker.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

}
