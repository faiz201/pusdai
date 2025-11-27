@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Indeks Pemantauan Perilaku dan Gaya Hidup Pegawai</h1>
</div>

<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Rekapitulasi Indeks Pemantauan Perilaku dan Gaya Hidup Pegawai</h5>
    <div>
        <a href="{{ route('pgh.export.excel') }}" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <a href="{{ route('pgh.create') }}" class="btn btn-primary btn-sm">
            + Tambah Kegiatan
        </a>
    </div>
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

    {{-- ==========================
        TABEL 2 — Kertas Aplikasi
    =========================== --}}
        <h5 class="mt-4 mb-2">Kertas Aplikasi</h5>
        <div class="table-responsive mb-4">
            <table class="table table-bordered text-center align-middle">

                <thead class="table-secondary fw-bold">
                    <tr>
                        <th>Triwulan</th>
                        <th>Indeks Pelaksanaan Setahun</th>
                        <th>Indeks Peserta Kegiatan</th>
                        <th>Output Project Learning</th>
                        <th>Indeks Total</th>
                        <th>Kesimpulan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->periode }}</td>
                        <td>{{ $d->indeks_pelaksanaan_dalam_setahun }}</td>
                        <td>{{ $d->indeks_peserta_kegiatan }}</td>
                        <td>{{ $d->output_project_learning }}</td>
                        <td>{{ $d->indeks_total }}</td>
                        <td>
                            @switch($d->kesimpulan)
                                @case('Belum Memadai')
                                    <span class="badge bg-secondary">Belum Memadai</span>
                                    @break
                                @case('Kurang')
                                    <span class="badge bg-danger">Kurang</span>
                                    @break
                                @case('Baik')
                                    <span class="badge bg-primary">Baik</span>
                                    @break
                                @case('Sangat Baik')
                                    <span class="badge bg-success">Sangat Baik</span>
                                    @break
                                @default
                                    -
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('pgh.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pgh.destroy', $d->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
</div>
@endsection
