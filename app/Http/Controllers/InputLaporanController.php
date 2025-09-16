<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\InputLaporan;  
use App\Models\Monitoring;  

class InputLaporanController extends Controller  
{  
    /**  
     * Display a listing of the resource.  
     */  
    public function index()  
    {  
        $laporan = InputLaporan::orderBy('updated_at', 'desc')->get();  
        return view('backend.v_inputlaporan.index', [  
            'judul' => 'Data Input Laporan',  
            'index' => $laporan  
        ]);  
    }  

    /**  
     * Show the form for creating a new resource.  
     */  
    public function create()  
    {  
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get();  
        return view('backend.v_inputlaporan.create', [  
            'judul' => 'Tambah Input Laporan',  
            'monitoring' => $monitoring
        ]);  
    }  

    /**  
     * Store a newly created resource in storage.  
     */  
    public function store(Request $request)  
    {  
        $validatedData = $request->validate([  
            'monitoring_id' => 'required',  
            'judul_laporan' => 'required|max:255|unique:input_laporan',  
            'detail' => 'required',  
            'status' => 'required',  
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|file|max:1024',  
        ], [  
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',  
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'  
        ]);  

        $validatedData['user_id'] = auth()->id();  

        if ($request->file('foto')) {  
            $validatedData['foto'] = $request->file('foto')->store('img-laporan', 'public');  
        }  

        InputLaporan::create($validatedData);  
        return redirect()->route('backend.inputlaporan.index')->with('success', 'Data berhasil tersimpan');  
    }  

    /**  
     * Display the specified resource.  
     */  
    public function show(string $id)  
    {  
        $laporan = InputLaporan::findOrFail($id);  
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get();  
        return view('backend.v_inputlaporan.show', [  
            'judul' => 'Detail Input Laporan',  
            'show' => $laporan,  
            'monitoring' => $monitoring
        ]);  
    }  

    /**  
     * Show the form for editing the specified resource.  
     */  
    public function edit(string $id)  
    {  
        $laporan = InputLaporan::findOrFail($id);  
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get();  
        return view('backend.v_inputlaporan.edit', [  
            'judul' => 'Ubah Input Laporan',  
            'edit' => $laporan,  
            'monitoring' => $monitoring  
        ]);  
    }  

    /**  
     * Update the specified resource in storage.  
     */  
    public function update(Request $request, string $id)  
    {  
        $laporan = InputLaporan::findOrFail($id);  
        $rules = [  
            'judul_laporan' => 'required|max:255' . $id,  
            'seksi' => 'required',  
            'status' => 'required',  
            'detail' => 'required',  
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',  
        ];  

        $validatedData = $request->validate($rules, [  
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',  
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'  
        ]);  

        $validatedData['user_id'] = auth()->id();  

        if ($request->file('foto')) {  
            // hapus foto lama jika ada
            if ($laporan->foto && file_exists(storage_path('app/public/'.$laporan->foto))) {
                unlink(storage_path('app/public/'.$laporan->foto));
            }
            $validatedData['foto'] = $request->file('foto')->store('img-laporan', 'public');  
        }  

        $laporan->update($validatedData);  
        return redirect()->route('backend.inputlaporan.index')->with('success', 'Data berhasil diperbaharui');  
    }  

    /**  
     * Remove the specified resource from storage.  
     */  
    public function destroy($id)  
    {  
        $laporan = InputLaporan::findOrFail($id);  

        if ($laporan->foto && file_exists(storage_path('app/public/'.$laporan->foto))) {
            unlink(storage_path('app/public/'.$laporan->foto));
        }

        $laporan->delete();  
        return redirect()->route('backend.inputlaporan.index')->with('success', 'Data berhasil dihapus');  
    }  

    /**  
     * Method untuk Form Laporan Input Laporan  
     */  
    public function formLaporan()  
    {  
        return view('backend.v_inputlaporan.form', [  
            'judul' => 'Laporan Data Input Laporan',  
        ]);  
    }  

    /**  
     * Method untuk Cetak Laporan Input Laporan  
     */  
    public function cetakLaporan(Request $request)  
    {  
        $request->validate([  
            'tanggal_awal' => 'required|date',  
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',  
        ], [  
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',  
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',  
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',  
        ]);  

        $tanggalAwal = $request->input('tanggal_awal');  
        $tanggalAkhir = $request->input('tanggal_akhir');  

        $laporan = InputLaporan::whereBetween('updated_at', [$tanggalAwal, $tanggalAkhir])  
            ->orderBy('id', 'desc')  
            ->get();  

        return view('backend.v_inputlaporan.cetak', [  
            'judul' => 'Laporan Input Laporan',  
            'tanggalAwal' => $tanggalAwal,  
            'tanggalAkhir' => $tanggalAkhir,  
            'cetak' => $laporan  
        ]);  
    }  
}