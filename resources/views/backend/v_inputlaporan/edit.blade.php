@extends('backend.v_layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $judul }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('backend.inputlaporan.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="seksi">Seksi</label>
                <select name="seksi" id="seksi" class="form-control @error('seksi') is-invalid @enderror">
                    <option value="">-- Pilih Seksi --</option>
                    @foreach($monitoring as $m)
                        <option value="{{ $m->id }}" {{ old('seksi', $edit->seksi) == $m->id ? 'selected' : '' }}>
                            {{ $m->seksi }}
                        </option>
                    @endforeach
                </select>
                @error('seksi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group mb-3">
                <label for="judul_laporan">Judul Laporan</label>
                <input type="text" name="judul_laporan" id="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" value="{{ old('judul_laporan', $edit->judul_laporan) }}">
                @error('judul_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group mb-3">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" rows="5" class="form-control @error('detail') is-invalid @enderror">{{ old('detail', $edit->detail) }}</textarea>
                @error('detail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="proses" {{ old('status', $edit->status)=='proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ old('status', $edit->status)=='selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui</button>
            <a href="{{ route('backend.inputlaporan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection