@extends('backend.v_layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $judul }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('backend.inputlaporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Monitoring -->
            <div class="form-group mb-3">
                <label for="seksi">Seksi</label>
                <select name="seksi" id="seksi" class="form-control @error('seksi') is-invalid @enderror">
                    <option value="">-- Pilih Seksi --</option>
                    @foreach($monitoring as $m)
                        <option value="{{ $m->id }}" {{ old('seksi') == $m->id ? 'selected' : '' }}>
                            {{ $m->seksi }}
                        </option>
                    @endforeach
                </select>
                @error('seksi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Judul -->
            <div class="form-group mb-3">
                <label for="judul">Judul</label>
                <input type="text" 
                       name="judul" 
                       id="judul" 
                       value="{{ old('judul') }}" 
                       class="form-control @error('judul') is-invalid @enderror">
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" 
                          id="deskripsi" 
                          rows="4" 
                          class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('backend.inputlaporan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>
@endsection