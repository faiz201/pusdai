@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Indeks Sosialisasi Antikorupsi</h1>
</div>

<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Rekapitulasi Indeks Sosialisasi Antikorupsi</h5>
    <div>
        <a href="{{ route('sosialisasiantikorupsi.export.excel') }}" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <a href="{{ route('sosialisasiantikorupsi.create') }}" class="btn btn-primary btn-sm">
            + Tambah Kegiatan
        </a>
    </div>
</div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($data->isEmpty())
            <div class="alert alert-warning">Data belum tersedia.</div>
        @else

            {{-- ==========================
                TABEL 1 — Rencana & Realisasi
            =========================== --}}
            <h5 class="mt-3 mb-2">Rencana & Realisasi Pelaksanaan Kegiatan</h5>
            <div class="table-responsive mb-5">
                <table class="table table-bordered text-center align-middle">

                    <thead>
                        <tr class="fw-bold" style="background:#f4c898;">
                            <th rowspan="2">No</th>
                            <th colspan="6">Rencana Kegiatan</th>
                            <th colspan="6" style="background:#b7ddb5;">Realisasi Pelaksanaan Kegiatan</th>
                            <th rowspan="2">Aksi</th>
                        </tr>

                        <tr style="background:#fffbe6;">
                            <th>Periode</th>
                            <th>Jenis Kegiatan</th>
                            <th>Waktu</th>
                            <th>Tema</th>
                            <th>Tempat</th>

                            <th>Narasumber</th>      
                            <th>Jumlah Peserta</th>
                            <th>Sasaran</th>
                            <th>Indeks Efektivitas</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $index => $d)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            {{-- Rencana --}}
                            <td>{{ $d->periode }}</td>
                            <td>{{ $d->jenis_kegiatan ?? '-' }}</td>
                            <td>{{ $d->waktu ?? '-' }}</td>
                            <td>{{ $d->tema ?? '-' }}</td>
                            <td>{{ $d->tempat ?? '-' }}</td>

                            {{-- Realisasi --}}
                            <td>{{ $d->narasumber ?? '-' }}</td>
                            <td>{{ $d->jumlah_peserta ?? '-' }}</td>\
                            <td>{{ $d->sasaran ?? '-' }}</td>
                            <td>{{ $d->indeks_efektivitas ?? '-' }}</td>
                            <td>{{ $d->keterangan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('sosialisasiantikorupsi.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('sosialisasiantikorupsi.destroy', $d->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
                                <a href="{{ route('sosialisasiantikorupsi.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('sosialisasiantikorupsi.destroy', $d->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

             <hr>

            {{-- ==========================
                GRAFIK
            =========================== --}}
            <div class="mt-4">
                <h5>Grafik Perbandingan Indeks per Triwulan</h5>
                <canvas id="chartIndeks" height="120"></canvas>
            </div>
            
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartIndeks').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Indeks Total',
            data: {!! json_encode($totals) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endpush