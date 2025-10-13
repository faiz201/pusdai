@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Tambah Kegiatan Pembinaan Mental</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pembinaanmental.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Periode</label>
                <select name="periode" class="form-control" required>
                    <option value="">-- Pilih Periode --</option>
                    <option value="Triwulan I">Triwulan I</option>
                    <option value="Triwulan II">Triwulan II</option>
                    <option value="Triwulan III">Triwulan III</option>
                    <option value="Triwulan IV">Triwulan IV</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="nama_satker">Satker</label>
                <select name="satker_id" id="nama_satker" class="form-control" required>
                    <option value="">-- Pilih Satker --</option>
                    @foreach($satker as $index => $m)
                        <option value="{{ $m->id }}"
                            {{ isset($pembinaamental) && $pembinaamental->satker_id == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_satker }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Indeks Pelaksanaan Dalam Setahun</label>
                <input type="number" name="indeks_pelaksanaan_dalam_setahun" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Indeks Peserta Kegiatan</label>
                <input type="number" name="indeks_peserta_kegiatan" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Output Project Learning</label>
                <input type="number" name="output_project_learning" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pembinaanmental.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
