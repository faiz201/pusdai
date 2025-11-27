<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PGH;
use App\Models\Satker;
use App\Exports\PGHExport;
use Maatwebsite\Excel\Facades\Excel;

class PGHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PGH::with('satker')->get();
        $totals = $data->pluck('indeks_total');

        return view('backend.v_pgh.index', compact('data', 'totals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satker = Satker::all();
        return view('backend.v_pgh.create', compact('satker'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'satker_id' => 'required|exists:satker,id',

            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:1|max:4',
            'indeks_peserta_kegiatan' => 'required|integer|min:1|max:4',
            'output_project_learning' => 'required|integer|min:1|max:4',
            
            'dasar_pelaksanaan' => 'required|string',
            'objek_pemantauan' => 'required|string',
            'jenis_dugaan' => 'required|string',
            'penyelesaian' => 'nullable|string',
            'status_terbukti' => 'nullable|string',
            'laporan_hasil' => 'nullable|string',
            'dasar_rekomendasi' => 'nullable|string',
            'jenis_rekomendasi' => 'nullable|string',
            'status_tindak_lanjut' => 'nullable|string',
            'dasar_tindak_lanjut' => 'nullable|string',
            'keterangan' => 'nullable|string',
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

        PGH::create([
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'dasar_pelaksanaan'   => $request->dasar_pelaksanaan,
            'objek_pemantauan'             => $request->objek_pemantauan,
            'jenis_dugaan'            => $request->jenis_dugaan,
            'penyelesaian'           => $request->penyelesaian,
            'status_terbukti'       => $request->status_terbukti,
            'laporan_hasil'   => $request->laporan_hasil,
            'dasar_rekomendasi' => $request->dasar_rekomendasi,
            'jenis_rekomendasi'          => $request->jenis_rekomendasi,
            'status_tindak_lanjut'       => $request->status_tindak_lanjut,
            'dasar_tindak_lanjut'        => $request->dasar_tindak_lanjut,
            'keterangan'                 => $request->keterangan
            ]);
        return redirect()->route('pgh.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pgh = PGH::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_pgh.edit', compact('pgh', 'satker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'satker_id' => 'required|exists:satker,id',

            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:1|max:4',
            'indeks_peserta_kegiatan' => 'required|integer|min:1|max:4',
            'output_project_learning' => 'required|integer|min:1|max:4',

            'dasar_pelaksanaan' => 'required|string',
            'objek_pemantauan' => 'required|string',
            'jenis_dugaan' => 'required|string',
            'penyelesaian' => 'nullable|string',
            'status_terbukti' => 'nullable|string',
            'laporan_hasil' => 'nullable|string',
            'dasar_rekomendasi' => 'nullable|string',
            'jenis_rekomendasi' => 'nullable|string',
            'status_tindak_lanjut' => 'nullable|string',
            'dasar_tindak_lanjut' => 'nullable|string',
            'keterangan' => 'nullable|string',
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

        PGH::create([
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'dasar_pelaksanaan'   => $request->dasar_pelaksanaan,
            'objek_pemantauan'             => $request->objek_pemantauan,
            'jenis_dugaan'            => $request->jenis_dugaan,
            'penyelesaian'           => $request->penyelesaian,
            'status_terbukti'       => $request->status_terbukti,
            'laporan_hasil'   => $request->laporan_hasil,
            'dasar_rekomendasi' => $request->dasar_rekomendasi,
            'jenis_rekomendasi'          => $request->jenis_rekomendasi,
            'status_tindak_lanjut'       => $request->status_tindak_lanjut,
            'dasar_tindak_lanjut'        => $request->dasar_tindak_lanjut,
            'keterangan'                 => $request->keterangan
            ]);
        return redirect()->route('pgh.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PGH::findOrFail($id)->delete();
        return redirect()->route('pgh.index')->with('success', 'Data berhasil dihapus');
    }

    public function exportExcel()
    {
        $filename = 'perilaku_gaya_hidup_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PGHExport, $filename);
    }
}
