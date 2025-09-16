@extends('backend.v_layouts.app')

@section('content_title', 'Edit Monitoring')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Satuan Kerja</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('backend.monitoring.update', $edit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="seksi" class="form-label">Seksi</label>
                <input type="text" name="seksi" id="seksi" value="{{ old('seksi', $edit->seksi) }}" class="form-control @error('seksi') is-invalid @enderror">
                @error('seksi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea name="kegiatan" id="kegiatan" class="form-control">{{ old('kegiatan', $edit->kegiatan) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="selesai" {{ old('status', $edit->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="belom selesai" {{ old('status', $edit->status) == 'belom selesai' ? 'selected' : '' }}>Belom Selesai</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('backend.monitoring.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection