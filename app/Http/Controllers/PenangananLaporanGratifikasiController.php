<?php

namespace App\Http\Controllers;

use App\Models\PenangananLaporanGratifikasi;
use Illuminate\Http\Request;
use App\Models\Satker;

class PenangananLaporanGratifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PenangananLaporanGratifikasi::with('satker')->get();
        return view('backend.v_ppg.index', compact('data'));
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
            'nomor_sig' => 'required',
            'jenis' => 'required',
            'bentuk_pemberian' => 'required',
            'objek_penanganan' => 'required',
            'nilai_taksiran' => 'required|numeric',
            'kategori_pemberi' => 'required',
            'proses_bisnis' => 'nullable',
            'status_kpk' => 'nullable',
            'nomor_sk' => 'nullable',
            'tindak_lanjut' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        PenangananLaporanGratifikasi::create($request->all());
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
        $data = PenangananLaporanGratifikasi::findOrFail($id);
        $data->update($request->all());
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
}
