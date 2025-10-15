@extends('backend.v_layouts.app')

@section('content_title', 'Tambah Sosialisasi Antikorupsi')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Data Sosialisasi Antikorupsi</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('sosialisasiantikorupsi.store') }}" method="POST">
            @csrf

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
                            <option value="">-- Pilih Periode --</option>
                            <option value="Triwulan I">Triwulan I</option>
                            <option value="Triwulan II">Triwulan II</option>
                            <option value="Triwulan III">Triwulan III</option>
                            <option value="Triwulan IV">Triwulan IV</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Kegiatan</label>
                        <input type="text" name="jenis_kegiatan" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tema</label>
                        <input type="text" name="tema" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Waktu</label>
                        <input type="text" name="waktu" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Tempat</label>
                        <input type="text" name="tempat" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Narasumber</label>
                        <input type="text" name="narasumber" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Sasaran</label>
                        <input type="text" name="sasaran" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Indeks Efektivitas</label>
                        <input type="text" name="indeks_efektivitas" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('sosialisasiantikorupsi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>
@endsection
