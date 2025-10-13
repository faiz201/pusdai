@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Indeks Pembinaan Mental</h1>
</div>

<div class="card">
    <div class="card-header justify-content-between">
        <h4>Rekapitulasi Indeks Pembinaan Mental</h4>
        <a href="{{ route('pembinaanmental.create') }}" class="btn btn-primary">+ Tambah Kegiatan</a>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($data->isEmpty())
            <div class="alert alert-warning">Data belum tersedia.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Nama Satker</th>
                            <th>Periode</th>
                            <th>Indeks Pelaksanaan Dalam Setahun</th>
                            <th>Indeks Peserta Kegiatan</th>
                            <th>Output Project Learning</th>
                            <th>Indeks Total</th>
                            <th>Kesimpulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->satker->nama_satker ?? '-' }}</td>
                                <td>{{ $d->periode }}</td>
                                <td>{{ $d->indeks_pelaksanaan_dalam_setahun }}</td>
                                <td>{{ $d->indeks_peserta_kegiatan }}</td>
                                <td>{{ $d->output_project_learning }}</td>
                                <td>{{ $d->indeks_total }}</td>
                                <td>
                                    <span class="badge badge-{{ $d->kesimpulan == 'Sangat Baik' ? 'success' : 'info' }}">
                                        {{ $d->kesimpulan }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pembinaanmental.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('pembinaanmental.destroy', $d->id) }}" method="POST" class="d-inline">
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