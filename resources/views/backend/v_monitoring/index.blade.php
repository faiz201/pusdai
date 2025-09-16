@extends('backend.v_layouts.app')

@section('content_title', 'Monitoring')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">Satuan Kerja</h4>
        <a href="{{ route('backend.monitoring.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Seksi</th>
                    <th>Kegiatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($index as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->seksi }}</td>
                    <td>{{ $item->kegiatan ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status == 'selesai' ? 'success' : 'secondary' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('backend.monitoring.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('backend.monitoring.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection