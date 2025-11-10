<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembinaanMental;
use App\Models\Satker;
use App\Exports\PembinaanMentalExport;
use Maatwebsite\Excel\Facades\Excel;

class PembinaanMentalController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        $periode = $request->input('periode');
        $satker = $request->input('satker');

        $data = PembinaanMental::with('satker')
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->when($periode, fn($q) => $q->where('periode', $periode))
            ->when($satker, fn($q) => $q->whereHas('satker', fn($sq) => $sq->where('nama_satker', 'like', "%$satker%")))
            ->orderBy('id', 'asc')
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
            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:0',
            'indeks_peserta_kegiatan' => 'required|integer|min:0',
            'output_project_learning' => 'required|integer|min:0',
        ]);

        $indeks_total = $request->indeks_pelaksanaan_dalam_setahun
            + $request->indeks_peserta_kegiatan
            + $request->output_project_learning;

        $kesimpulan = match (true) {
            $indeks_total < 3 => 'Belum Memadai',
            $indeks_total < 5 => 'Kurang',
            $indeks_total < 7 => 'Baik',
            default => 'Sangat Baik',
        };

        PembinaanMental::create([
            'periode' => $request->periode,
            'satker_id' => $request->satker_id,
            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $indeks_total,
            'kesimpulan' => $kesimpulan,
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
            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:0',
            'indeks_peserta_kegiatan' => 'required|integer|min:0',
            'output_project_learning' => 'required|integer|min:0',
        ]);

        $indeks_total = $request->indeks_pelaksanaan_dalam_setahun
            + $request->indeks_peserta_kegiatan
            + $request->output_project_learning;

        $kesimpulan = match (true) {
            $indeks_total < 3 => 'Belum Memadai',
            $indeks_total < 5 => 'Kurang',
            $indeks_total < 7 => 'Baik',
            default => 'Sangat Baik',
        };

        PembinaanMental::findOrFail($id)->update([
            'periode' => $request->periode,
            'satker_id' => $request->satker_id,
            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $indeks_total,
            'kesimpulan' => $kesimpulan,
        ]);

        return redirect()->route('pembinaanmental.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PembinaanMental::findOrFail($id)->delete();
        return redirect()->route('pembinaanmental.index')->with('success', 'Data berhasil dihapus!');
    }

    // ✅ Tambahan fitur Export Excel
    public function exportExcel()
    {
        $filename = 'pembinaan_mental_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PembinaanMentalExport, $filename);
    }
}
