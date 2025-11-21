<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EdukasiPencegahanPelanggaranPegawai;
use App\Models\Satker;
use App\Exports\EdukasiExport;
use Maatwebsite\Excel\Facades\Excel;

class EdukasiPencegahanPelanggaranPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $satker = $request->input('satker');

        $data = EdukasiPencegahanPelanggaranPegawai::with('satker')
            ->when($satker, fn($q) =>
                $q->whereHas('satker', fn($sq) =>
                    $sq->where('nama_satker', 'like', "%{$satker}%")
                )
            )
            ->orderByRaw("
                CASE 
                    WHEN periode = 'Triwulan I' THEN 1
                    WHEN periode = 'Triwulan II' THEN 2
                    WHEN periode = 'Triwulan III' THEN 3
                    WHEN periode = 'Triwulan IV' THEN 4
                    ELSE 5
                END
            ")
            ->get();

        $labels = $data->pluck('periode');
        $totals = $data->pluck('indeks_total');
        
        return view('backend.v_edukasi.index', compact('data', 'labels', 'totals'));
    }

    public function create()
    {
        return view('backend.v_edukasi.create', [
            'satker' => Satker::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode'          => 'required|string',
            'satker_id'        => 'required|exists:satker,id',

            // Indeks bidang lama
            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:1|max:4',
            'indeks_peserta_kegiatan' => 'required|integer|min:1|max:4',
            'output_project_learning' => 'required|integer|min:1|max:4',

            // Tambahan dari tabel
            'jenis_kegiatan'   => 'required|string',
            'tema'             => 'nullable|string',
            'waktu'            => 'nullable|string',
            'tempat'           => 'nullable|string',
            'narasumber'       => 'nullable|string',
            'jumlah_peserta'   => 'nullable|numeric',
            'sasaran'          => 'nullable|string',
            'keterangan'       => 'nullable|string',
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

        EdukasiPencegahanPelanggaranPegawai::create([
            'periode' => $request->periode,
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'jenis_kegiatan'   => $request->jenis_kegiatan,
            'tema'             => $request->tema,
            'waktu'            => $request->waktu,
            'tempat'           => $request->tempat,
            'narasumber'       => $request->narasumber,
            'jumlah_peserta'   => $request->jumlah_peserta,
            'sasaran'          => $request->sasaran,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('edukasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data  = EdukasiPencegahanPelanggaranPegawai::findOrFail($id);
        $satker = Satker::all();
        return view('backend.v_edukasi.edit', compact('data', 'satker'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'periode'          => 'required|string',
            'satker_id'        => 'required|exists:satker,id',

            // Indeks bidang lama
            'indeks_pelaksanaan_dalam_setahun' => 'required|integer|min:1|max:4',
            'indeks_peserta_kegiatan' => 'required|integer|min:1|max:4',
            'output_project_learning' => 'required|integer|min:1|max:4',

            // Tambahan dari tabel
            'jenis_kegiatan'   => 'required|string',
            'tema'             => 'nullable|string',
            'waktu'            => 'nullable|string',
            'tempat'           => 'nullable|string',
            'narasumber'       => 'nullable|string',
            'jumlah_peserta'   => 'nullable|numeric',
            'sasaran'          => 'nullable|string',
            'keterangan'       => 'nullable|string',
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

        EdukasiPencegahanPelanggaranPegawai::create([
            'periode' => $request->periode,
            'satker_id' => $request->satker_id,

            'indeks_pelaksanaan_dalam_setahun' => $request->indeks_pelaksanaan_dalam_setahun,
            'indeks_peserta_kegiatan' => $request->indeks_peserta_kegiatan,
            'output_project_learning' => $request->output_project_learning,
            'indeks_total' => $total,
            'kesimpulan' => $kesimpulan,

            // Field tambahan
            'jenis_kegiatan'   => $request->jenis_kegiatan,
            'tema'             => $request->tema,
            'waktu'            => $request->waktu,
            'tempat'           => $request->tempat,
            'narasumber'       => $request->narasumber,
            'jumlah_peserta'   => $request->jumlah_peserta,
            'sasaran'          => $request->sasaran,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('edukasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        EdukasiPencegahanPelanggaranPegawai::findOrFail($id)->delete();
        return redirect()->route('edukasi.index')->with('success', 'Data berhasil dihapus');
    }

    public function exportExcel()
    {
        $filename = 'sosialisasi_antikorupsi_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new EdukasiExport, $filename);
    }
}
