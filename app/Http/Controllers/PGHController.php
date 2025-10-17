<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PGH;
use App\Models\Satker;

class PGHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PGH::with('satker')->get();
        return view('backend.v_pgh.index', compact('data'));
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
        $validated = $request->validate([
            'satker_id' => 'required|exists:satker,id',
            'dasar_pelaksanaan' => 'required',
            'objek_pemantauan' => 'required',
            'jenis_dugaan' => 'required',
            'penyelesaian' => 'nullable',
            'status_terbukti' => 'nullable',
            'laporan_hasil' => 'nullable',
            'dasar_rekomendasi' => 'nullable',
            'jenis_rekomendasi' => 'nullable',
            'status_tindak_lanjut' => 'nullable',
            'dasar_tindak_lanjut' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        PGH::create($validated);
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
        $pgh = PGH::findOrFail($id);

        $validated = $request->validate([
            'satker_id' => 'required|exists:satker,id',
            'dasar_pelaksanaan' => 'required',
            'objek_pemantauan' => 'required',
            'jenis_dugaan' => 'required',
            'penyelesaian' => 'nullable',
            'status_terbukti' => 'nullable',
            'laporan_hasil' => 'nullable',
            'dasar_rekomendasi' => 'nullable',
            'jenis_rekomendasi' => 'nullable',
            'status_tindak_lanjut' => 'nullable',
            'dasar_tindak_lanjut' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $pgh->update($validated);
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
}
