@extends('backend.v_layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>{{ $judul }}</h4>
        <a href="{{ route('backend.inputlaporan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th>Judul Laporan</th>
                        <th>Seksi</th>
                        <th>Status</th>
                        <th>Updated At</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($index as $key => $laporan)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $laporan->judul_laporan }}</td>
                            <td>{{ $laporan->seksi->seksi ?? '_' }}
                            <td>
                                <span class="badge {{ $laporan->status == 'selesai' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </td>
                            <td>
                                @if($laporan->foto)
                                    <img src="{{ asset('storage/'.$laporan->foto) }}" alt="Foto" width="80" class="img-thumbnail">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $laporan->updated_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('backend.inputlaporan.show', $laporan->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('backend.inputlaporan.edit', $laporan->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('backend.inputlaporan.destroy', $laporan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection