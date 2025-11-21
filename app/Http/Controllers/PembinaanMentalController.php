<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembinaanMental;
use App\Models\Satker;
use App\Exports\PembinaanMentalMultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;

class PembinaanMentalController extends Controller
{
    public function index(Request $request)
    {
        $satker = $request->input('satker');

        $data = PembinaanMental::with('satker')
            ->when($satker, fn($q) =>
                $q->whereHas('satker', fn($sq) =>
                    $sq->where('nama_satker', 'like', "%{$satker}%")
                )
            )
            ->orderByRaw("
                CASE 
                    WHEN periode = 'Triwulan I' THEN 1
                    WHEN periode = 'Triwulan II' THEN 2
                    WHEN periode = 'Triwulan III' THEN 3
                    WHEN periode = 'Triwulan IV' THEN 4
                    ELSE 5
                END
            ")
            ->get();

        $labels = $data->pluck('periode');
        $totals = $data->pluck('indeks_total');

        return view('backend.v_pembinaanmental.index', compact('data', 'labels', 'totals'));
    }

    public function create()
    {
        $satker = Satker::all();
        return view('backend.v_pembinaanmental.create', compact('satker'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required|string',
            'satker_id' => 'required|exists:satker,id',

            // Indeks bidang lama
            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:1|max:4',
            'indeks_peserta_kegiatan' => 'required|integer|min:1|max:4',
            'output_project_learning' => 'required|integer|min:1|max:4',

            // Tambahan dari tabel
            'program_kegiatan' => 'nullable|string',
            'ruang_lingkup' => 'nullable|string',
            'waktu_rencana' => 'nullable|string',
            'tema' => 'nullable|string',
            'tempat' => 'nullable|string',

            'waktu_pelaksanaan' => 'nullable|string',
            'peran_pejabat' => 'nullable|string',
            'narasi_peran' => 'nullable|string',
            'jumlah_peserta' => 'nullable|integer',
            'output_manfaat' => 'nullable|string',
            'link_dokumentasi' => 'nullable|string',
        ]);

        $total =
            $request->indeks_pelaksanaan_dalam_setahun +
            $request->indeks_peserta_kegiatan +
            $request->output_project_learning;

        $kesimpulan = match (true) {
            $total < 3 => 'Belum Memadai',
            $total < 5 => 'Kurang',
            $total < 7 => 'Baik',
            default => 'Sangat Baik',
        };

        PembinaanMental::create([
            'periode' => $request->periode,
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'program_kegiatan' => $request->program_kegiatan,
            'ruang_lingkup' => $request->ruang_lingkup,
            'waktu' => $request->waktu,
            'tema' => $request->tema,
            'tempat' => $request->tempat,

            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'peran_pejabat_administrator' => $request->peran_pejabat_administrator,
            'narasi_singkat_peran' => $request->narasi_singkat_peran,
            'jumlah_peserta' => $request->jumlah_peserta,
            'output_manfaat' => $request->output_manfaat,
            'link_dokumentasi' => $request->link_dokumentasi,
        ]);

        return redirect()->route('pembinaanmental.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PembinaanMental::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_pembinaanmental.edit', compact('data', 'satker'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'periode' => 'required|string',
            'satker_id' => 'required|exists:satker,id',

            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:1|max:4',
            'indeks_peserta_kegiatan' => 'required|integer|min:1|max:4',
            'output_project_learning' => 'required|integer|min:1|max:4',

            'program_kegiatan' => 'nullable|string',
            'ruang_lingkup' => 'nullable|string',
            'waktu_rencana' => 'nullable|string',
            'tema' => 'nullable|string',
            'tempat' => 'nullable|string',

            'waktu_pelaksanaan' => 'nullable|string',
            'peran_pejabat' => 'nullable|string',
            'narasi_peran' => 'nullable|string',
            'jumlah_peserta' => 'nullable|integer',
            'output_manfaat' => 'nullable|string',
            'link_dokumentasi' => 'nullable|string',
        ]);

        $total =
            $request->indeks_pelaksanaan_dalam_setahun +
            $request->indeks_peserta_kegiatan +
            $request->output_project_learning;

        $kesimpulan = match (true) {
            $total < 3 => 'Belum Memadai',
            $total < 5 => 'Kurang',
            $total < 7 => 'Baik',
            default => 'Sangat Baik',
        };

        PembinaanMental::where('id', $id)->update([
            'periode' => $request->periode,
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            'program_kegiatan' => $request->program_kegiatan,
            'ruang_lingkup' => $request->ruang_lingkup,
            'waktu' => $request->waktu,
            'tema' => $request->tema,
            'tempat' => $request->tempat,

            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'peran_pejabat_administrator' => $request->peran_pejabat_administrator,
            'narasi_singkat_peran' => $request->narasi_singkat_peran,
            'jumlah_peserta' => $request->jumlah_peserta,
            'output_manfaat' => $request->output_manfaat,
            'link_dokumentasi' => $request->link_dokumentasi,
        ]);

        return redirect()->route('pembinaanmental.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PembinaanMental::findOrFail($id)->delete();
        return redirect()->route('pembinaanmental.index')->with('success', 'Data berhasil dihapus!');
    }

    public function exportExcel()
    {
        $filename = 'pembinaan_mental_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PembinaanMentalMultiSheetExport, $filename);
    }
}
