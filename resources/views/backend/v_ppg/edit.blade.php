@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Edit Laporan PPG (Penanganan Laporan Penanganan)</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('ppg.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Satker</label>
                    <select name="satker_id" class="form-select">
                        @foreach($satker as $s)
                            <option value="{{ $s->id }}" {{ $data->satker_id == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_satker }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor SIG</label>
                    <input type="text" name="nomor_sig" value="{{ $data->nomor_sig }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" value="{{ $data->jenis }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Objek Penanganan</label>
                    <input type="text" name="objek_penanganan" value="{{ $data->objek_penanganan }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Bentuk Pemberian</label>
                    <input type="text" name="bentuk_pemberian" value="{{ $data->bentuk_pemberian }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nilai Taksiran</label>
                    <input type="number" name="nilai_taksiran" value="{{ $data->nilai_taksiran }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Pemberi</label>
                    <input type="text" name="kategori_pemberi" value="{{ $data->kategori_pemberi }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Proses Bisnis Terkait</label>
                    <input type="text" name="proses_bisnis" value="{{ $data->proses_bisnis }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Penetapan oleh KPK</label>
                    <input type="text" name="status_kpk" value="{{ $data->status_kpk }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor SK Penetapan</label>
                    <input type="text" name="nomor_sk" value="{{ $data->nomor_sk }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tindak Lanjut</label>
                    <input type="text" name="tindak_lanjut" value="{{ $data->tindak_lanjut }}" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control">{{ $data->keterangan }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('ppg.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
