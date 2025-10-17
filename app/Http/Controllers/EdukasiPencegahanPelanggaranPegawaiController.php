<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EdukasiPencegahanPelanggaranPegawai;
use App\Models\Satker;

class EdukasiPencegahanPelanggaranPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = EdukasiPencegahanPelanggaranPegawai::with('satker')->get();
        return view('backend.v_edukasi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satker = Satker::all();
        return view('backend.v_edukasi.create', compact('satker'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'satker_id' => 'required|exists:satker,id',
            'periode' => 'required',
            'jenis_kegiatan' => 'required',
        ]);

        EdukasiPencegahanPelanggaranPegawai::create($request->all());
        return redirect()->route('edukasi.index')
                         ->with('success', 'Data berhasil ditambahkan');
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
        $data = EdukasiPencegahanPelanggaranPegawai::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_edukasi.edit', compact('data', 'satker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = EdukasiPencegahanPelanggaranPegawai::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('edukasi.index')
                         ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        EdukasiPencegahanPelanggaranPegawai::findOrFail($id)->delete();
        return redirect()->route('edukasi.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
