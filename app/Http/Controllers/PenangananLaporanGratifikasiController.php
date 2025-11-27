<?php

namespace App\Http\Controllers;

use App\Models\PenangananLaporanGratifikasi;
use Illuminate\Http\Request;
use App\Models\Satker;
use App\Exports\PPGExport;
use Maatwebsite\Excel\Facades\Excel;

class PenangananLaporanGratifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PenangananLaporanGratifikasi::with('satker')->get();
        $totals = $data->pluck('indeks_total');
        return view('backend.v_ppg.index', compact('data', 'totals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satker = Satker::all();
        return view('backend.v_ppg.create', compact('satker'));
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

            'nomor_sig' => 'required|string',
            'jenis' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'objek_penanganan' => 'required|string',
            'nilai_taksiran' => 'required|numeric',
            'kategori_pemberi' => 'required|string',
            'proses_bisnis' => 'nullable|string',
            'status_kpk' => 'nullable|string',
            'nomor_sk' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
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

        PenangananLaporanGratifikasi::create([
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'nomor_sig'   => $request->nomor_sig,
            'jenis'             => $request->jenis,
            'bentuk_pemberian'            => $request->jenis_dugaan,
            'objek_penanganan'           => $request->objek_penanganan,
            'nilai_taksiran'       => $request->status_terbukti,
            'kategori_pemberi'   => $request->kategori_pemberi,
            'proses_bisnis' => $request->proses_bisnis,
            'status_kpk'          => $request->status_kpk,
            'nomor_sk'       => $request->nomor_sk,
            'tindak_lanjut'        => $request->tindak_lanjut,
            'keterangan'                 => $request->keterangan
        ]);
        return redirect()->route('ppg.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PenangananLaporanGratifikasi::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_ppg.edit', compact('data', 'satker'));
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

            'nomor_sig' => 'required|string',
            'jenis' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'objek_penanganan' => 'required|string',
            'nilai_taksiran' => 'required|numeric',
            'kategori_pemberi' => 'required|string',
            'proses_bisnis' => 'nullable|string',
            'status_kpk' => 'nullable|string',
            'nomor_sk' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
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

        PenangananLaporanGratifikasi::create([
            'satker_id' => $request->satker_id,
            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'nomor_sig'   => $request->nomor_sig,
            'jenis'             => $request->jenis,
            'jenis_dugaan'            => $request->jenis_dugaan,
            'objek_penanganan'           => $request->objek_penanganan,
            'status_terbukti'       => $request->status_terbukti,
            'kategori_pemberi'   => $request->kategori_pemberi,
            'proses_bisnis' => $request->proses_bisnis,
            'status_kpk'          => $request->status_kpk,
            'nomor_sk'       => $request->nomor_sk,
            'tindak_lanjut'        => $request->tindak_lanjut,
            'keterangan'                 => $request->keterangan
            ]);
        return redirect()->route('ppg.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PenangananLaporanGratifikasi::findOrFail($id)->delete();
        return redirect()->route('ppg.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportExcel()
    {
        $filename = 'perilaku_gaya_hidup_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PPGExport, $filename);
    }
}
