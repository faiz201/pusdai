@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid px-4 py-3 bg-light" style="min-height: 100vh;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">Dashboard Performa Pencegahan</h4>
        <div>
            <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2">
                <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="{{ request('tahun') }}">
                <input type="text" name="bulan" class="form-control" placeholder="Bulan" value="{{ request('bulan') }}">
                <input type="text" name="unit" class="form-control" placeholder="Satuan Kerja" value="{{ request('unit') }}">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="mb-4">
        <form method="GET" action="{{ route('dashboard.export.excel') }}" class="d-inline">
            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            <input type="hidden" name="unit" value="{{ request('satker') }}">
            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
        </form>

        <form method="GET" action="{{ route('dashboard.export.csv') }}" class="d-inline">
            <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            <input type="hidden" name="unit" value="{{ request('satker') }}">
            <button type="submit" class="btn btn-info btn-sm"><i class="bi bi-file-earmark-arrow-down"></i> Export CSV</button>
        </form>
    </div>

    <!-- 📈 Chart Section -->
    <div class="row g-4 mb-4">
        <!-- Pie Chart -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Distribusi Kegiatan Pencegahan
                </div>
                <div class="card-body">
                    <canvas id="chartDistribusi" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Top 10 / Bottom 10 -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    10 Satker Terbaik
                </div>
                <div class="card-body">
                    <canvas id="chartTop10" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-bold">
                    10 Satker Attensi
                </div>
                <div class="card-body">
                    <canvas id="chartBottom10" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 🧾 Table Data -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold">
            Rekapitulasi Performa Pencegahan
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Satuan Kerja</th>
                        <th>Pembinaan Mental</th>
                        <th>Sosialisasi Antikorupsi</th>
                        <th>Edukasi Pencegahan</th>
                        <th>Pengendalian Gratifikasi</th>
                        <th>Pemantauan Perilaku</th>
                        <th>Pemantauan LHK</th>
                        <th>Pelaksanaan Monev ZI</th>
                        <th>Analisis Data</th>
                        <th>Penanganan Survey</th>
                        <th>Penanganan Pengaduan</th>
                        <th>Simpulan Performa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($satker as $index => $m)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td class="fw-bold">{{ $m['nama_satker'] }}</td>
                            <td>{{ $m['pembinaan_mental'] }}</td>
                            <td>{{ $m['sosialisasi_antikorupsi'] }}</td>
                            <td>{{ $m['edukasi_pencegahan_pelanggaran_pegawai'] }}</td>
                            <td>{{ $m['penanganan_laporan_gratifikasi'] }}</td>
                            <td>{{ $m['pemantauan_perilaku_gaya_hidup_pegawai'] }}</td>
                            <td>{{ $m['pelaksanaan_monev_zi'] }}</td>
                            <td class="fw-bold text-center">{{ $m['total_nilai'] }}</td>
                            <td><strong>{{ $m['simpulan_performa_pencegahan'] }}</strong></td>
                        </tr>
                    @empty
                        <tr><td colspan="14" class="text-center text-muted">Data tidak tersedia</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const top10 = {!! json_encode($top10->values()) !!};
    const bottom10 = {!! json_encode($bottom10->values()) !!};

    // === PIE CHART ===
    const distribusiData = {
        labels: [
            'Pembinaan Mental',
            'Sosialisasi Antikorupsi',
            'Edukasi Pencegahan',
            'Pengendalian Gratifikasi',
            'Pemantauan Perilaku',
            'Pemantauan LHK',
            'Pelaksanaan Monev ZI'
        ],
        datasets: [{
            data: [30, 20, 15, 10, 10, 8, 7],
            backgroundColor: [
                '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6f42c1', '#20c997'
            ]
        }]
    };
    new Chart(document.getElementById('chartDistribusi').getContext('2d'), {
        type: 'pie',
        data: distribusiData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: { size: 11 }
                    }
                },
                title: { display: false }
            }
        }
    });

    // === BAR CHART: Top 10 ===
    new Chart(document.getElementById('chartTop10').getContext('2d'), {
        type: 'bar',
        data: {
            labels: top10.map(item => item.nama_satker),
            datasets: [{
                label: 'Total Nilai',
                data: top10.map(item => item.total_nilai),
                backgroundColor: '#28a745'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    // === BAR CHART: Bottom 10 ===
    new Chart(document.getElementById('chartBottom10').getContext('2d'), {
        type: 'bar',
        data: {
            labels: bottom10.map(item => item.nama_satker),
            datasets: [{
                label: 'Total Nilai',
                data: bottom10.map(item => item.total_nilai),
                backgroundColor: '#dc3545'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
