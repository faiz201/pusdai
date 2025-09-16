<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use App\Helpers\ImageHelper; 

class UserController extends Controller 
{ 
    /** 
     * Display a listing of the resource. 
     */ 
    public function index() 
    { 
        $users = User::orderBy('updated_at', 'desc')->get(); 
        return view('backend.v_user.index', [ 
            'judul' => 'Data User', 
            'index' => $users 
        ]); 
    } 

    /** 
     * Show the form for creating a new resource. 
     */ 
    public function create() 
    { 
        return view('backend.v_user.create', [ 
            'judul' => 'Tambah User', 
        ]); 
    } 

    /** 
     * Store a newly created resource in storage. 
     */ 
    public function store(Request $request) 
    { 
        $validatedData = $request->validate([ 
            'nama' => 'required|max:255', 
            'email' => 'required|max:255|email|unique:users', 
            'role' => 'required', 
            'hp' => 'required|min:10|max:13', 
            'password' => 'required|min:4|confirmed', 
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024', 
        ], [ 
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.', 
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.' 
        ]); 

        $validatedData['status'] = 0; 

        // Handle image upload
        if ($request->file('foto')) { 
            $validatedData['foto'] = $this->handleImageUpload($request->file('foto')); 
        } 

        // Validate password strength
        if ($this->isValidPassword($request->input('password'))) { 
            $validatedData['password'] = Hash::make($validatedData['password']); 
            User::create($validatedData); 
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan'); 
        } else { 
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']); 
        } 
    } 

    /** 
     * Show the form for editing the specified resource. 
     */ 
    public function edit(string $id) 
    { 
        $user = User::findOrFail($id); 
        return view('backend.v_user.edit', [ 
            'judul' => 'Ubah User', 
            'edit' => $user 
        ]); 
    } 

    /** 
     * Update the specified resource in storage. 
     */ 
    public function update(Request $request, string $id) 
    { 
        $user = User::findOrFail($id); 
        $rules = [ 
            'nama' => 'required|max:255', 
            'role' => 'required', 
            'status' => 'required', 
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024', 
        ]; 

        if ($request->email != $user->email) { 
            $rules['email'] = 'required|max:255|email|unique:users'; 
        } 

        $validatedData = $request->validate($rules); 

        // Handle image upload
        if ($request->file('foto')) { 
            // Delete old image
            if ($user->foto) { 
                $this->deleteOldImage($user->foto); 
            } 
            $validatedData['foto'] = $this->handleImageUpload($request->file('foto')); 
        } 

        $user->update($validatedData); 
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbaharui'); 
    } 

    /** 
     * Remove the specified resource from storage. 
     */ 
    public function destroy(string $id) 
    { 
        $user = User::findOrFail($id); 
        if ($user->foto) { 
            $this->deleteOldImage($user->foto); 
        } 
        $user->delete(); 
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil dihapus'); 
    } 

    /** 
     * Show the form for user report. 
     */ 
    public function formUser () 
    { 
        return view('backend.v_user.form', [ 
            'judul' => 'Laporan Data User', 
        ]); 
    } 

    /** 
     * Generate user report based on date range. 
     */ 
    public function cetakUser (Request $request) 
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

        $users = User::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]) 
            ->orderBy('id', 'desc') 
            ->get(); 

        return view('backend.v_user.cetak', [ 
            'judul' => 'Laporan User', 
            'tanggalAwal' => $tanggalAwal, 
            'tanggalAkhir' => $tanggalAkhir, 
            'cetak' => $users 
        ]); 
    } 

    // Private methods
    private function handleImageUpload($file) 
    {
        $extension = $file->getClientOriginalExtension(); 
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension; 
        $directory = 'storage/img-user/'; 
        ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); 
        return $originalFileName; 
    }

    private function deleteOldImage($filename) 
    {
        $oldImagePath = public_path('storage/img-user/') . $filename; 
        if (file_exists($oldImagePath)) { 
            unlink($oldImagePath); 
        } 
    }

    private function isValidPassword($password) 
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'; 
        return preg_match($pattern, $password);
    }
}