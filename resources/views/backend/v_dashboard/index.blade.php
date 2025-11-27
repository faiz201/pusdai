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

    <!-- 📊 Grafik Top 5 dan Attensi 5 -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">5 Satker Terbaik</div>
                <div class="card-body"><canvas id="chartTop5" height="250"></canvas></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-bold">5 Satker Attensi</div>
                <div class="card-body"><canvas id="chartBottom5" height="250"></canvas></div>
            </div>
        </div>
    </div>

    <!-- 🧭 Grafik Kuadran Performa Satker -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white fw-bold">Kuadran Performa Satker</div>
        <div class="card-body">
            <canvas id="chartQuadrant" height="400"></canvas>
        </div>
    </div>

    <!-- 🧾 Tabel Data -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold">Rekapitulasi Performa Pencegahan</div>
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
                        <th>Total Nilai</th>
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
                            <td>{{ $m['pemantauan_pemenuhan_kewajiban_lhk'] }}</td>
                            <td>{{ $m['pelaksanaan_monev_zi'] }}</td>
                            <td>{{ $m['analisis_data_informasi_pegawai'] }}</td>
                            <td>{{ $m['hasil_survei_kinerja_organisasi'] }}</td>
                            <td>{{ $m['penanganan_pengaduan_masyarakat'] }}</td>
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

<!-- Chart.js + Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2.2.1"></script>

<script>
    const top5 = {!! json_encode($top5->values()) !!};
    const bottom5 = {!! json_encode($bottom5->values()) !!};
    const quadrantData = {!! json_encode($quadrantData ?? []) !!};

    // === HORIZONTAL BAR: Top 5 ===
    new Chart(document.getElementById('chartTop5').getContext('2d'), {
        type: 'bar',
        data: {
            labels: top5.map(item => item.nama_satker),
            datasets: [{
                label: 'Total Nilai',
                data: top5.map(item => item.total_nilai),
                backgroundColor: '#28a745'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true } }
        }
    });

    // === HORIZONTAL BAR: Attensi 5 ===
    new Chart(document.getElementById('chartBottom5').getContext('2d'), {
        type: 'bar',
        data: {
            labels: bottom5.map(item => item.nama_satker),
            datasets: [{
                label: 'Total Nilai',
                data: bottom5.map(item => item.total_nilai),
                backgroundColor: '#dc3545'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true } }
        }
    });

    // === SCATTER: Kuadran Performa Satker ===
    const ctxQuadrant = document.getElementById('chartQuadrant').getContext('2d');
    new Chart(ctxQuadrant, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Satuan Kerja',
                data: quadrantData,
                backgroundColor: context => {
                    const x = context.raw?.x ?? 0;
                    const y = context.raw?.y ?? 0;
                    if (x >= 1 && y < 1) return '#0d6efd'; // Kuadran III - Baik (biru)
                    if (x < 1 && y >= 1) return '#ffc107'; // Kuadran II - Kurang (kuning)
                    if (x < 1 && y < 1) return '#dc3545'; // Kuadran IV - Attensi (merah)
                    return '#28a745'; // Kuadran I - Sangat Baik (hijau)
                },
                borderColor: '#fff',
                borderWidth: 1,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.raw.label}: (X=${context.raw.x}, Y=${context.raw.y})`;
                        }
                    }
                },
                annotation: {
                    annotations: {
                        xLine: { type: 'line', xMin: 1, xMax: 1, borderColor: '#888', borderWidth: 1 },
                        yLine: { type: 'line', yMin: 1, yMax: 1, borderColor: '#888', borderWidth: 1 }
                    }
                }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Indeks Kinerja' },
                    min: 0, max: 2,
                    grid: { color: '#ddd' }
                },
                y: {
                    title: { display: true, text: 'Nilai Capaian' },
                    min: 0, max: 2,
                    grid: { color: '#ddd' }
                }
            }
        }
    });
</script>
@endsection