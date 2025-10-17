<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemantauan;
use App\Models\Satker;

class PemantauanZIController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        $query = Pemantauan::with('satker');

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        $tahunList = Pemantauan::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        return view('backend.v_pemantauan.index', compact('data', 'tahunList', 'tahun', 'bulan'));
    }

    // 🆕 Form tambah data
    public function create()
    {
        $satker = Satker::all();
        return view('backend.v_pemantauan.create', compact('satker'));
    }

    // 🆕 Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
        'nama_satker' => 'required|string|max:255',
        'tahun_predikat' => 'required|integer',
        'pemeliharaan_wbk' => 'required|boolean',
        'pencanangan_wbbm' => 'required|boolean',
        'proses_penilaian_wbbm' => 'required|boolean',
        'predikat_wbbm' => 'nullable|string|max:255',
    ]);

    $data = Pemantauan::create($validated);

    return response()->json(['success' => true, 'data' => $data]);
    }

    public function edit($id)
    {
        $data = Pemantauan::findOrFail($id);
        $satkers = Satker::all();
        return view('backend.v_pemantauan.edit', compact('data', 'satkers'));
    }

    public function update(Request $request, $id)
    {
        $data = Pemantauan::findOrFail($id);
        $data->update([
            'satker_id' => $request->satker_id,
            'tahun_predikat' => $request->tahun_predikat,
            'pemeliharaan_wbk' => $request->has('pemeliharaan_wbk'),
            'pencanangan_wbbm' => $request->has('pencanangan_wbbm'),
            'proses_penilaian_wbbm' => $request->has('proses_penilaian_wbbm'),
            'predikat_wbbm' => $request->predikat_wbbm,
        ]);

        return redirect()->route('pemantauan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemantauan::findOrFail($id)->delete();
        return redirect()->route('pemantauan.index')->with('success', 'Data berhasil dihapus.');
    }
}
