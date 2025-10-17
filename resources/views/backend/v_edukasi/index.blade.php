@extends('backend.v_layouts.app')

@section('content_title', 'Edukasi Pencegahan Pelanggaran Pegawai')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Edukasi Pencegahan Pelanggaran Pegawai</h4>
        <a href="{{ route('edukasi.create') }}" class="btn btn-primary btn-sm">
            + Tambah Data
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Satker</th>
                        <th>Periode</th>
                        <th>Jenis Kegiatan</th>
                        <th>Tema</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Narasumber</th>
                        <th>Jumlah Peserta</th>
                        <th>Sasaran</th>
                        <th>Indeks Efektivitas</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->satker?->nama_satker ?? '-' }}</td>
                            <td>{{ $item->periode }}</td>
                            <td>{{ $item->jenis_kegiatan }}</td>
                            <td>{{ $item->tema }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->narasumber }}</td>
                            <td>{{ $item->jumlah_peserta }}</td>
                            <td>{{ $item->sasaran }}</td>
                            <td>{{ $item->indeks_efektivitas }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <a href="{{ route('edukasi.edit', $item->id) }}" 
                                   class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('edukasi.destroy', $item->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
