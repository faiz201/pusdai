@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Tambah Laporan PPG (Penanganan Laporan Gratifikasi)</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('ppg.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Satker</label>
                    <select name="satker_id" class="form-select @error('satker_id') is-invalid @enderror">
                        <option value="">-- Pilih Satker --</option>
                        @foreach($satker as $s)
                            <option value="{{ $s->id }}" {{ old('satker_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_satker }}
                            </option>
                        @endforeach
                    </select>
                    @error('satker_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor SIG</label>
                    <input type="text" name="nomor_sig" value="{{ old('nomor_sig') }}" class="form-control @error('nomor_sig') is-invalid @enderror">
                    @error('nomor_sig') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" value="{{ old('jenis') }}" class="form-control @error('jenis') is-invalid @enderror">
                    @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Objek Penanganan</label>
                    <input type="text" name="objek_penanganan" value="{{ old('objek_penanganan') }}" class="form-control @error('objek_gratifikasi') is-invalid @enderror">
                    @error('objek_gratifikasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Bentuk Pemberian</label>
                    <input type="text" name="bentuk_pemberian" value="{{ old('bentuk_pemberian') }}" class="form-control @error('bentuk_pemberian') is-invalid @enderror">
                    @error('bentuk_pemberian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nilai Taksiran</label>
                    <input type="number" name="nilai_taksiran" value="{{ old('nilai_taksiran') }}" class="form-control @error('nilai_taksiran') is-invalid @enderror">
                    @error('nilai_taksiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Pemberi</label>
                    <input type="text" name="kategori_pemberi" value="{{ old('kategori_pemberi') }}" class="form-control @error('kategori_pemberi') is-invalid @enderror">
                    @error('kategori_pemberi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Proses Bisnis Terkait</label>
                    <input type="text" name="proses_bisnis" value="{{ old('proses_bisnis_terkait') }}" class="form-control @error('proses_bisnis_terkait') is-invalid @enderror">
                    @error('proses_bisnis_terkait') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Penetapan oleh KPK</label>
                    <input type="text" name="status_kpk" value="{{ old('status_penetapan_kpk') }}" class="form-control @error('status_penetapan_kpk') is-invalid @enderror">
                    @error('status_penetapan_kpk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor SK Penetapan</label>
                    <input type="text" name="nomor_sk" value="{{ old('nomor_sk_penetapan') }}" class="form-control @error('nomor_sk_penetapan') is-invalid @enderror">
                    @error('nomor_sk_penetapan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tindak Lanjut</label>
                    <input type="text" name="tindak_lanjut" value="{{ old('tindak_lanjut') }}" class="form-control @error('tindak_lanjut') is-invalid @enderror">
                    @error('tindak_lanjut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('ppg.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
