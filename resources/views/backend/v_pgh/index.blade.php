@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Pemantauan Perilaku dan Gaya Hidup Pegawai</h1>
    <a href="{{ route('pgh.create') }}" class="btn btn-primary ms-auto">+ Tambah Data</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Satker</th>
                    <th>Dasar Pelaksanaan</th>
                    <th>Objek Pemantauan</th>
                    <th>Jenis Dugaan</th>
                    <th>Penyelesaian</th>
                    <th>Terbukti/Tidak</th>
                    <th>Laporan Hasil</th>
                    <th>Dasar Rekomendasi</th>
                    <th>Jenis Rekomendasi</th>
                    <th>Status TL</th>
                    <th>Dasar TL</th>
                    <th>Keterangan</th>
                    <th width="130">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->satker->nama_satker ?? '-' }}</td>
                    <td>{{ $item->dasar_pelaksanaan }}</td>
                    <td>{{ $item->objek_pemantauan }}</td>
                    <td>{{ $item->jenis_dugaan }}</td>
                    <td>{{ $item->penyelesaian }}</td>
                    <td>{{ $item->status_terbukti }}</td>
                    <td>{{ $item->laporan_hasil }}</td>
                    <td>{{ $item->dasar_rekomendasi }}</td>
                    <td>{{ $item->jenis_rekomendasi }}</td>
                    <td>{{ $item->status_tindak_lanjut }}</td>
                    <td>{{ $item->dasar_tindak_lanjut }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <a href="{{ route('pgh.edit', $item->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('pgh.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="14" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
