@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Penanganan Laporan Gratifikasi (PPG)</h1>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Laporan PPG</h4>
        <a href="{{ route('ppg.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
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
                    <th>Objek Gratifikasi<br>(Penerimaan/Penolakan)</th>
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
                        <td>{{ $item->objek_gratifikasi }}</td>
                        <td>{{ $item->bentuk_pemberian }}</td>
                        <td>{{ $item->nilai_taksiran }}</td>
                        <td>{{ $item->kategori_pemberi }}</td>
                        <td>{{ $item->proses_bisnis_terkait }}</td>
                        <td>{{ $item->status_penetapan_kpk }}</td>
                        <td>{{ $item->nomor_sk_penetapan }}</td>
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
</div>
@endsection
