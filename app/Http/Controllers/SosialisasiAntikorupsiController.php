<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SosialisasiAntikorupsi;
use App\Models\Satker;

class SosialisasiAntikorupsiController extends Controller
{
    public function index()
    {
        $data = SosialisasiAntikorupsi::with('satker')->get();
        return view('backend.v_sosialisasiantikorupsi.index', compact('data'));
    }

    public function create()
    {
        $satker = Satker::all();
        return view('backend.v_sosialisasiantikorupsi.create', compact('satker'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satker_id' => 'required|exists:satker,id',
            'periode' => 'required',
            'jenis_kegiatan' => 'required',
        ]);

        SosialisasiAntikorupsi::create($request->all());
        return redirect()->route('sosialisasiantikorupsi.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = SosialisasiAntikorupsi::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_sosialisasiantikorupsi.edit', compact('data', 'satker'));
    }

    public function update(Request $request, $id)
    {
        $data = SosialisasiAntikorupsi::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('sosialisasiantikorupsi.index')
                         ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        SosialisasiAntikorupsi::findOrFail($id)->delete();
        return redirect()->route('sosialisasiantikorupsi.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
