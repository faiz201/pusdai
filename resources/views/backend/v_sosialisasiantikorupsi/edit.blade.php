@extends('backend.v_layouts.app')

@section('content_title', 'Edit Sosialisasi Antikorupsi')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Data Sosialisasi Antikorupsi</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('sosialisasiantikorupsi.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nama_satker">Satker</label>
                <select name="satker_id" id="nama_satker" class="form-control" required>
                    <option value="">-- Pilih Satker --</option>
                    @foreach($satker as $m)
                        <option value="{{ $m->id }}" {{ old('satker_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_satker }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Periode</label>
                        <select name="periode" class="form-control" required>
                            <option value="Triwulan I" {{ $data->periode == 'Triwulan I' ? 'selected' : '' }}>Triwulan I</option>
                            <option value="Triwulan II" {{ $data->periode == 'Triwulan II' ? 'selected' : '' }}>Triwulan II</option>
                            <option value="Triwulan III" {{ $data->periode == 'Triwulan III' ? 'selected' : '' }}>Triwulan III</option>
                            <option value="Triwulan IV" {{ $data->periode == 'Triwulan IV' ? 'selected' : '' }}>Triwulan IV</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Kegiatan</label>
                        <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $data->jenis_kegiatan }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Tema</label>
                        <input type="text" name="tema" class="form-control" value="{{ $data->tema }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Waktu</label>
                        <input type="text" name="waktu" class="form-control" value="{{ $data->waktu }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Tempat</label>
                        <input type="text" name="tempat" class="form-control" value="{{ $data->tempat }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Narasumber</label>
                        <input type="text" name="narasumber" class="form-control" value="{{ $data->narasumber }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" class="form-control" value="{{ $data->jumlah_peserta }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Sasaran</label>
                        <input type="text" name="sasaran" class="form-control" value="{{ $data->sasaran }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Indeks Efektivitas</label>
                        <input type="text" name="indeks_efektivitas" class="form-control" value="{{ $data->indeks_efektivitas }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $data->keterangan }}</textarea>
                    </div>
                </div>
            </div>

            <button class="btn btn-success"><i class="fas fa-save"></i> Update</button>
            <a href="{{ route('sosialisasiantikorupsi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>
@endsection
