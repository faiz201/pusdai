@extends('backend.v_layouts.app')

@section('content')
<h4 class="mb-3">Tambah Data Pemantauan Zona Integritas DJBC</h4>

<form action="{{ route('pemantauan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Satker</label>
        <select name="satker_id" class="form-select" required>
            <option value="">-- Pilih Satker --</option>
            @foreach($satker as $s)
                <option value="{{ $s->id }}">{{ $s->nama_satker }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tahun Predikat ZI WBK</label>
        <input type="text" name="tahun_predikat" class="form-control" placeholder="Contoh: 2023">
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="pemeliharaan_wbk" value="1" class="form-check-input">
        <label class="form-check-label">Pemeliharaan WBK</label>
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="pencanangan_wbbm" value="1" class="form-check-input">
        <label class="form-check-label">Pencanangan WBBM</label>
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="proses_penilaian_wbbm" value="1" class="form-check-input">
        <label class="form-check-label">Proses Penilaian WBBM</label>
    </div>

    <div class="mb-3">
        <label>Predikat WBBM</label>
        <input type="text" name="predikat_wbbm" class="form-control" placeholder="Contoh: WBBM / WBK">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('pemantauan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
