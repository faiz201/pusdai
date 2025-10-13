<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputLaporan;
use App\Models\Monitoring;

class InputLaporanController extends Controller
{
    /** Tampilkan daftar laporan */
    public function index()
    {
        $laporan = InputLaporan::with('monitoring')
            ->orderBy('updated_at', 'desc')
            ->take(10) // tampilkan hanya 10 data terbaru
            ->get();

        return view('backend.v_inputlaporan.index', [
            'judul' => 'Data Input Laporan',
            'index' => $laporan
        ]);
    }

    /** Form tambah laporan */
    public function create()
    {
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get();
        return view('backend.v_inputlaporan.create', [
            'judul' => 'Tambah Input Laporan',
            'monitoring' => $monitoring
        ]);
    }

    /** Simpan laporan baru */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'monitoring_id' => 'required',
            'judul_laporan' => 'required|max:255|unique:input_laporan',
            'detail' => 'required',
            'status' => 'required',
        ]);

        $validatedData['user_id'] = auth()->id();

        InputLaporan::create($validatedData);
        return redirect()->route('backend.inputlaporan.index')->with('success', 'Data berhasil tersimpan');
    }

    /** Detail laporan */
    public function show(string $id)
    {
        $laporan = InputLaporan::with('monitoring')->findOrFail($id);
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get();

        return view('backend.v_inputlaporan.show', [
            'judul' => 'Detail Input Laporan',
            'show' => $laporan,
            'seksi' => $monitoring
        ]);
    }

    /** Form edit laporan */
    public function edit(string $id)
    {
        $laporan = InputLaporan::with('monitoring')->findOrFail($id);
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get();

        return view('backend.v_inputlaporan.edit', [
            'judul' => 'Ubah Input Laporan',
            'edit' => $laporan,
            'monitoring' => $monitoring
        ]);
    }

    /** Update laporan */
    public function update(Request $request, string $id)
    {
        $laporan = InputLaporan::findOrFail($id);

        $validatedData = $request->validate([
            'monitoring_id' => 'required',
            'judul_laporan' => 'required|max:255',
            'detail' => 'required',
            'status' => 'required',
        ]);

        $validatedData['user_id'] = auth()->id();

        $laporan->update($validatedData);

        return redirect()->route('backend.inputlaporan.index')->with('success', 'Data berhasil diperbarui');
    }

    /** Hapus laporan */
    public function destroy($id)
    {
        $laporan = InputLaporan::findOrFail($id);

        $laporan->delete();
        return redirect()->route('backend.inputlaporan.index')->with('success', 'Data berhasil dihapus');
    }
}
