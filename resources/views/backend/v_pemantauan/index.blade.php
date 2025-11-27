@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Indeks Pemantauan Zona Integritas DJBC</h1>
</div>

<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Rekapitulasi Indeks Pemantauan Zona Integritas DJBC</h5>
    <div>
        <a href="{{ route('pemantauan.export.excel') }}" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <a href="{{ route('pemantauan.create') }}" class="btn btn-primary btn-sm">
            + Tambah Kegiatan
        </a>
    </div>
</div>

    {{-- Filter Tahun/Bulan --}}
    <form method="GET" action="{{ route('pemantauan.index') }}" class="d-flex mb-3">
        <input type="number"
               name="tahun"
               class="form-control me-2"
               style="width: 150px;"
               placeholder="Masukkan Tahun"
               value="{{ request('tahun') ?? date('Y') }}"
               min="2000"
               max="{{ date('Y') + 1 }}">

        <select name="bulan" class="form-select me-2" style="width: 200px;">
            <option value="">-- Pilih Bulan --</option>
            @for($i=1; $i<=12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                </option>
            @endfor
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    {{-- Tabel --}}
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Satker</th>
                <th>Tahun Predikat ZI WBK</th>
                <th>Pemeliharaan WBK</th>
                <th>Pencanangan WBBM</th>
                <th>Proses Penilaian WBBM</th>
                <th>Predikat WBBM</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->satker->nama_satker ?? '-' }}</td>
                    <td>{{ $row->tahun_predikat }}</td>
                    <td>{{ $row->pemeliharaan_wbk ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $row->pencanangan_wbbm ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $row->proses_penilaian_wbbm ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $row->predikat_wbbm ?? '-' }}</td>
                    <td>
                        <a href="{{ route('pemantauan.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemantauan.destroy', $row->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
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
                            <a href="{{ route('pemantauan.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pemantauan.destroy', $d->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
@endsection
