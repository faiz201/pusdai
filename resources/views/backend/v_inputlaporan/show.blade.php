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
                <td>{{ $show->seksi->monitoring ?? '-' }}</td>
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
                <th>Dibuat Oleh</th>
                <td>{{ $show->user->name ?? '_' }}</td>
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