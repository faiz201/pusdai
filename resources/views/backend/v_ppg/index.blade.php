@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Indeks Penanganan Laporan Gratifikasi</h1>
</div>

<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Rekapitulasi Indeks Penanganan Laporan Gratifikasi</h5>
    <div>
        <a href="{{ route('ppg.export.excel') }}" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <a href="{{ route('ppg.create') }}" class="btn btn-primary btn-sm">
            + Tambah Kegiatan
        </a>
    </div>
</div>

    <div class="card-body table-responsive">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover align-middle text-center" style="font-size: 14px;">
            <thead class="table-primary">
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Nama Satker</th>
                    <th>Nomor SIG</th>
                    <th>Jenis</th>
                    <th>Objek Penanganan<br>(Penerimaan/Penolakan)</th>
                    <th>Bentuk Pemberian</th>
                    <th>Nilai Taksiran</th>
                    <th>Kategori Pemberi</th>
                    <th>Proses Bisnis Terkait</th>
                    <th>Status Penetapan oleh KPK</th>
                    <th>Nomor SK Penetapan</th>
                    <th>Tindak Lanjut</th>
                    <th>Keterangan</th>
                    <th style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->satker->nama_satker ?? '-' }}</td>
                        <td>{{ $item->nomor_sig }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->objek_penanganan }}</td>
                        <td>{{ $item->bentuk_pemberian }}</td>
                        <td>{{ $item->nilai_taksiran }}</td>
                        <td>{{ $item->kategori_pemberi }}</td>
                        <td>{{ $item->proses_bisnis }}</td>
                        <td>{{ $item->status_kpk }}</td>
                        <td>{{ $item->nomor_sk }}</td>
                        <td>{{ $item->tindak_lanjut }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <a href="{{ route('ppg.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('ppg.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center">Belum ada data laporan gratifikasi.</td>
                    </tr>
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
                            <a href="{{ route('ppg.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('ppg.destroy', $d->id) }}" method="POST" class="d-inline">
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
