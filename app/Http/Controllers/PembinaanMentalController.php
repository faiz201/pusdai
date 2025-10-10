<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembinaanMental;
use App\Models\Satker;

class PembinaanMentalController extends Controller
{
    public function index()
    {
        $data = PembinaanMental::orderBy('id', 'asc')->get();
        $data = PembinaanMental::with('satker')->get();

        // Untuk grafik
        $labels = $data->pluck('periode');
        $totals = $data->pluck('indeks_total');

        return view('backend.v_pembinaanmental.index', compact('data', 'labels', 'totals'));
    }

    public function create()
    {
        $satker  = Satker::all();
        return view('backend.v_pembinaanmental.create', compact('satker'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama satker' => 'required|exists:nama satker',
            'periode' => 'required|string',
            'indeks_pelaksanaan_dalam_setahun' => 'required|integer',
            'indeks_peserta_kegiatan' => 'required|integer',
            'output_project_learning' => 'required|integer',
        ]);

        $validated['indeks_total'] =
            $validated['indeks_pelaksanaan_dalam_setahun'] +
            $validated['indeks_peserta_kegiatan'] +
            $validated['output_project_learning'];

        $validated['kesimpulan'] =
            $validated['indeks_total'] >= 7 ? 'Sangat Baik' : 'Baik';

        PembinaanMental::create($validated);

        return redirect()->route('pembinaanmental.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PembinaanMental::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_pembinaanmental.edit', compact('data','satker'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama satker' => 'required|exists:nama satker',
            'periode' => 'required|string',
            'indeks_pelaksanaan' => 'required|integer',
            'indeks_peserta' => 'required|integer',
            'output_project_learning' => 'required|integer',
        ]);

        $validated['indeks_total'] =
            $validated['indeks_pelaksanaan'] +
            $validated['indeks_peserta'] +
            $validated['output_project_learning'];

        $validated['kesimpulan'] =
            $validated['indeks_total'] >= 7 ? 'Sangat Baik' : 'Baik';

        PembinaanMental::findOrFail($id)->update($validated);

        return redirect()->route('pembinaanmental.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PembinaanMental::findOrFail($id)->delete();
        return redirect()->route('pembinaanmental.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
