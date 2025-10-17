@extends('backend.v_layouts.app')

@section('content')
<h4>Edit Data Pemantauan Zona Integritas</h4>

<form action="{{ route('pemantauan.update', $data->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Nama Satker</label>
        <select name="satker_id" class="form-select">
            @foreach($satkers as $s)
                <option value="{{ $s->id }}" {{ $data->satker_id == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tahun Predikat</label>
        <input type="text" name="tahun_predikat" value="{{ $data->tahun_predikat }}" class="form-control">
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="pemeliharaan_wbk" value="1" {{ $data->pemeliharaan_wbk ? 'checked' : '' }} class="form-check-input">
        <label class="form-check-label">Pemeliharaan WBK</label>
    </div>
    <div class="form-check mb-2">
        <input type="checkbox" name="pencanangan_wbbm" value="1" {{ $data->pencanangan_wbbm ? 'checked' : '' }} class="form-check-input">
        <label class="form-check-label">Pencanangan WBBM</label>
    </div>
    <div class="form-check mb-2">
        <input type="checkbox" name="proses_penilaian_wbbm" value="1" {{ $data->proses_penilaian_wbbm ? 'checked' : '' }} class="form-check-input">
        <label class="form-check-label">Proses Penilaian WBBM</label>
    </div>

    <div class="mb-3">
        <label>Predikat WBBM</label>
        <input type="text" name="predikat_wbbm" value="{{ $data->predikat_wbbm }}" class="form-control">
    </div>

    <button class="btn btn-success">Simpan Perubahan</button>
    <a href="{{ route('pemantauan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
