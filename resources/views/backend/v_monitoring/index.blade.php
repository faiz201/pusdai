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
                    <th>Total Skor</th>
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
                    <td>{{ $item->total_skor }}</td>
                    <td>{{ $item->kategori_total }}</td>
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