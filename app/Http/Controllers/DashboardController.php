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
use App\Models\Pemantauan;

class DashboardController extends Controller
{
    protected $satkerService;

    public function __construct(SatkerService $satkerService)
    {
        $this->satkerService = $satkerService;
    }

    /**
     * Halaman utama dashboard
     */
    public function index(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer',
            'bulan' => 'nullable|integer|min:1|max:12',
            'unit'  => 'nullable|string|max:255',
        ]);

        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $unit  = $request->input('unit');

        // Ambil data Satker yang sudah difilter
        $satker = $this->satkerService->getFiltered($tahun, $bulan, $unit);

        // Hitung top 10 dan bottom 10
        $top10 = $satker->sortByDesc('total_nilai')->take(10);
        $bottom10 = $satker->sortBy('total_nilai')->take(10);

        /**
         * 🔹 Distribusi Kegiatan Pencegahan (Pie Chart)
         * Sekarang mendukung filter tahun, bulan, dan unit/satker
         */
        $applyFilter = function ($query) use ($tahun, $bulan, $unit) {
            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }
            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }
            if ($unit) {
                $query->whereHas('satker', function ($sub) use ($unit) {
                    $sub->where('nama_satker', 'like', "%{$unit}%");
                });
            }
        };

        $distribusi = [
            'Pembinaan Mental' => PembinaanMental::where(function ($q) use ($applyFilter) {
                $applyFilter($q);
            })->count(),

            'Sosialisasi Antikorupsi' => SosialisasiAntikorupsi::where(function ($q) use ($applyFilter) {
                $applyFilter($q);
            })->count(),

            'Edukasi Pencegahan Pelanggaran Pegawai' => EdukasiPencegahanPelanggaranPegawai::where(function ($q) use ($applyFilter) {
                $applyFilter($q);
            })->count(),

            'Penanganan Laporan Gratifikasi' => PenangananLaporanGratifikasi::where(function ($q) use ($applyFilter) {
                $applyFilter($q);
            })->count(),

            'Perilaku Gaya Hidup Pegawai' => PGH::where(function ($q) use ($applyFilter) {
                $applyFilter($q);
            })->count(),

            'Pelaksanaan Monev ZI' => Pemantauan::where(function ($q) use ($applyFilter) {
                $applyFilter($q);
            })->count(),
        ];

        // Kirim data ke view
        return view('backend.v_dashboard.index', compact(
            'satker', 'tahun', 'bulan', 'unit',
            'top10', 'bottom10', 'distribusi'
        ));
    }

    /**
     * Endpoint AJAX filter dashboard
     */
    public function filter(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer',
            'bulan' => 'nullable|integer|min:1|max:12',
            'unit'  => 'nullable|string|max:255',
        ]);

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
            'summary'   => $summary,
            'top10'     => $top10,
            'bottom10'  => $bottom10,
        ]);
    }

    /**
     * Ambil detail singkat satu satker (untuk modal detail)
     */
    public function getDetail($id)
    {
        $satker = Satker::findOrFail($id);

        return response()->json([
            'id'          => $satker->id,
            'nama_satker' => $satker->nama_satker,
            'total_nilai' => rand(50, 100),
            'kesimpulan'  => 'Baik',
            'bidang'      => [
                'Pembinaan Mental'        => rand(50, 100),
                'Sosialisasi Antikorupsi' => rand(50, 100),
                'Gratifikasi'             => rand(50, 100),
                'Zona Integritas'         => rand(50, 100),
                'LHK'                     => rand(50, 100),
            ],
        ]);
    }

    /**
     * Ambil data lengkap 1 satker dari semua bidang
     */
    public function show($id)
    {
        $satker = Satker::findOrFail($id);

        $mental       = PembinaanMental::where('satker_id', $satker->id)->latest()->first();
        $sosialisasi  = SosialisasiAntikorupsi::where('satker_id', $satker->id)->latest()->first();
        $edukasi      = EdukasiPencegahanPelanggaranPegawai::where('satker_id', $satker->id)->latest()->first();
        $gratifikasi  = PenangananLaporanGratifikasi::where('satker_id', $satker->id)->latest()->first();
        $pemantauan   = PGH::where('satker_id', $satker->id)->latest()->first();
        $pelaksanaan  = Pemantauan::where('satker_id', $satker->id)->latest()->first();

        $nilai = [
            'Mental'       => $mental->total_nilai ?? 0,
            'Sosialisasi'  => $sosialisasi->total_nilai ?? 0,
            'Edukasi'      => $edukasi->total_nilai ?? 0,
            'Gratifikasi'  => $gratifikasi->total_nilai ?? 0,
            'Pemantauan'   => $pemantauan->total_nilai ?? 0,
            'Pelaksanaan'  => $pelaksanaan->total_nilai ?? 0,
        ];

        return response()->json([
            'nama_satker' => $satker->nama_satker,
            'total_nilai' => $satker->total_nilai ?? array_sum($nilai) / count($nilai),
            'kesimpulan'  => $mental->kesimpulan ?? '-',
            'bidang'      => $nilai,
        ]);
    }

    /**
     * Ekspor Excel
     */
    public function exportExcel(Request $request)
    {
        $filename = 'satker_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(
            new SatkerExport($request->tahun, $request->bulan, $request->satker),
            $filename
        );
    }

    /**
     * Ekspor CSV
     */
    public function exportCsv(Request $request)
    {
        $filename = 'satker_' . now()->format('Ymd_His') . '.csv';

        return Excel::download(
            new SatkerExport($request->tahun, $request->bulan, $request->satker),
            $filename,
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
