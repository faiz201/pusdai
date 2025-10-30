<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SatkerService;
use App\Exports\SatkerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{
    Satker,
    PembinaanMental,
    SosialisasiAntikorupsi,
    EdukasiPencegahanPelanggaranPegawai,
    PenangananLaporanGratifikasi,
    PGH,
    Pemantauan
};

class DashboardController extends Controller
{
    protected $satkerService;

    public function __construct(SatkerService $satkerService)
    {
        $this->satkerService = $satkerService;
    }

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

        $satker = $this->satkerService->getFiltered($tahun, $bulan, $unit);

        $top5 = $satker->sortByDesc('total_nilai')->take(5);
        $bottom5 = $satker->sortBy('total_nilai')->take(5);

        $applyFilter = function ($query) use ($tahun, $bulan, $unit) {
            if ($tahun) $query->whereYear('created_at', $tahun);
            if ($bulan) $query->whereMonth('created_at', $bulan);
            if ($unit) {
                $query->whereHas('satker', function ($sub) use ($unit) {
                    $sub->where('nama_satker', 'like', "%{$unit}%");
                });
            }
        };

        $distribusi = [
            'Pembinaan Mental' => PembinaanMental::where(fn($q) => $applyFilter($q))->count(),
            'Sosialisasi Antikorupsi' => SosialisasiAntikorupsi::where(fn($q) => $applyFilter($q))->count(),
            'Edukasi Pencegahan Pelanggaran Pegawai' => EdukasiPencegahanPelanggaranPegawai::where(fn($q) => $applyFilter($q))->count(),
            'Penanganan Laporan Gratifikasi' => PenangananLaporanGratifikasi::where(fn($q) => $applyFilter($q))->count(),
            'Perilaku Gaya Hidup Pegawai' => PGH::where(fn($q) => $applyFilter($q))->count(),
            'Pelaksanaan Monev ZI' => Pemantauan::where(fn($q) => $applyFilter($q))->count(),
        ];

        $quadrantData = $satker->map(function ($item) {
            return [
                'x' => round(($item['total_nilai'] ?? 0) / 10, 2), // contoh pembagian agar tetap dalam range kecil (0–2)
                'y' => round(rand(5, 10) / 5, 2), // simulasi variasi nilai (nanti bisa diganti rumus sesungguhnya)
                'label' => $item['nama_satker'],
            ];
        });

        return view('backend.v_dashboard.index', compact(
            'satker', 'tahun', 'bulan', 'unit',
            'top5', 'bottom5', 'distribusi', 'quadrantData'
        ));
    }

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

        $top5 = $satker->sortByDesc('total_nilai')->take(5)->values();
        $bottom5 = $satker->sortBy('total_nilai')->take(5)->values();

        return response()->json([
            'summary'  => $summary,
            'top5'     => $top5,
            'bottom'   => $bottom5,
        ]);
    }

    public function getDetail($id)
    {
        $satker = Satker::findOrFail($id);

        return response()->json([
            'id'          => $satker->id,
            'nama_satker' => $satker->nama_satker,
            'total_nilai' => $satker->total_nilai ?? rand(50, 100),
            'kesimpulan'  => 'Baik',
            'bidang'      => [
                'Pembinaan Mental'        => rand(60, 100),
                'Sosialisasi Antikorupsi' => rand(60, 100),
                'Gratifikasi'             => rand(60, 100),
                'Zona Integritas'         => rand(60, 100),
                'LHK'                     => rand(60, 100),
            ],
        ]);
    }

    public function exportExcel(Request $request)
    {
        $filename = 'satker_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(
            new SatkerExport($request->tahun, $request->bulan, $request->satker),
            $filename
        );
    }

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
