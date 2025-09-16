@extends('backend.v_layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $judul }}</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Judul Laporan</th>
                <td>{{ $show->judul_laporan }}</td>
            </tr>
            <tr>
                <th>Seksi</th>
                <td>{{ $show->seksi->seksi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Detail</th>
                <td>{{ $show->detail }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($show->status) }}</td>
            </tr>
            <tr>
                <th>Foto</th>
                <td>
                    @if($show->foto)
                        <img src="{{ asset('storage/'.$show->foto) }}" alt="Foto Laporan" width="300">
                    @else
                        <span class="text-muted">Tidak ada foto</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Dibuat Oleh</th>
                <td>{{ $show->user->name ?? 'User tidak ditemukan' }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $show->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        </table>

        <a href="{{ route('backend.inputlaporan.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </div>
</div>
@endsection