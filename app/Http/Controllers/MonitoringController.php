<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request;
use App\Models\Monitoring;

class MonitoringController extends Controller 
{ 
    /** 
     * Display a listing of the resource. 
     */ 
    public function index() 
    { 
        $monitoring = Monitoring::orderBy('seksi', 'asc')->get(); 
        return view('backend.v_monitoring.index', [ 
            'judul' => 'Monitoring', 
            'index' => $monitoring 
        ]); 
    } 
 
    /** 
     * Show the form for creating a new resource. 
     */ 
    public function create() 
    { 
        return view('backend.v_monitoring.create', [ 
            'judul' => 'monitoring',
        ]); 
    } 
 
    /** 
     * Store a newly created resource in storage. 
     */ 
    public function store(Request $request) 
    { 
        // dd($request); 
        $validatedData = $request->validate([ 
            'nama_monitoring' => 'required|max:255|unique:monitoring', 
        ]); 
        Monitoring::create($validatedData); 
        return redirect()->route('backend.monitoring.index')->with('success', 'Data berhasil 
tersimpan'); 
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
        $monitoring = Monitoring::find($id); 
        return view('backend.v_monitoring.edit', [ 
            'judul' => 'Monitoring', 
            'edit' => $monitoring 
        ]); 
    } 
 
    /** 
     * Update the specified resource in storage. 
     */ 
    public function update(Request $request, string $id)
    {
        $rules = [
            'seksi' => 'required|max:255' . $id,
            'kegiatan' => 'required',
            'status' => 'required|in:belom selesai,selesai',
        ];

        $validatedData = $request->validate($rules);

        Monitoring::where('id', $id)->update($validatedData);

        return redirect()->route('backend.monitoring.index')
            ->with('success', 'Data berhasil diperbaharui');
    }
 
    /** 
     * Remove the specified resource from storage. 
     */ 
    public function destroy(string $id) 
    { 
        $user = Monitoring::findOrFail($id); 
        $user->delete(); 
        return redirect()->route('backend.monitoring.index')->with('success', 'Data berhasil 
dihapus'); 
    } 
} 