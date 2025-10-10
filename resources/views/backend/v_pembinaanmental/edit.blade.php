@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Edit Data Pembinaan Mental</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pembinaanmental.update', $data->id) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="form-group">
                <label>Periode</label>
                <select name="triwulan" class="form-control" required>
                    <option value="Triwulan I" {{ $data->triwulan == 'Triwulan I' ? 'selected' : '' }}>Triwulan I</option>
                    <option value="Triwulan II" {{ $data->triwulan == 'Triwulan II' ? 'selected' : '' }}>Triwulan II</option>
                    <option value="Triwulan III" {{ $data->triwulan == 'Triwulan III' ? 'selected' : '' }}>Triwulan III</option>
                    <option value="Triwulan IV" {{ $data->triwulan == 'Triwulan IV' ? 'selected' : '' }}>Triwulan IV</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="satker_id">Satker</label>
                <select name="nama satker" id="nama satker" class="form-control" required>
                    <option value="">-- Pilih Satker --</option>
                    @foreach($satker as $index => $m)
                        <option value="{{ $m->id }}" {{ $pembinaanMental->nama_satker == $satker->id ? 'selected' : '' }}>
                            {{ $m->nama_satker }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Indeks Pelaksanaan Dalam Setahun</label>
                <input type="number" name="indeks_pelaksanaan_dalam_setahun" value="{{ $data->indeks_pelaksanaan_dalam_setahun }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Indeks Peserta Kegiatan</label>
                <input type="number" name="indeks_peserta_kegiatan" value="{{ $data->indeks_peserta_kegiatan }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Output Project Learning</label>
                <input type="number" name="output_project_learning" value="{{ $data->output_project_learning }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('pembinaanmental.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
