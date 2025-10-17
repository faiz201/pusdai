@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Performa Pencegahan</h4>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('dashboard') }}" class="row mb-3">
        <div class="col-md-3">
            <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="{{ request('tahun') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="bulan" class="form-control" placeholder="Bulan" value="{{ request('bulan') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="unit" class="form-control" placeholder="Satuan Kerja" value="{{ request('unit') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    {{-- Export Buttons --}}
    <form method="GET" action="{{ route('dashboard.export.excel') }}" class="d-inline">
        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
        <input type="hidden" name="unit" value="{{ request('satker') }}">
        <button type="submit" class="btn btn-success mb-2">Export Excel</button>
    </form>

    <form method="GET" action="{{ route('dashboard.export.csv') }}" class="d-inline">
        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
        <input type="hidden" name="unit" value="{{ request('satker') }}">
        <button type="submit" class="btn btn-info mb-2">Export CSV</button>
    </form>

    {{-- Grafik --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <h5 class="text-center">10 Satker Terbaik</h5>
            <canvas id="chartTop10"></canvas>
        </div>
        <div class="col-md-6">
            <h5 class="text-center">10 Satker Terburuk</h5>
            <canvas id="chartBottom10"></canvas>
        </div>
    </div>

    {{-- Table --}}
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Satuan Kerja</th>
                <th>Pembinaan Mental</th>
                <th>Sosialisasi Antikorupsi</th>
                <th>Edukasi Pencegahan</th>
                <th>Pengendalian Gratifikasi</th>
                <th>Pemantauan Perilaku dan Gaya Hidup Pegawai</th>
                <th>Pemantauan LHK</th>
                <th>Pelaksanaan Monev ZI</th>
                <th>Analisis Data Informasi Pegawai</th>
                <th>Penanganan Hasil Survey</th>
                <th>Penanganan Pengaduan Masyarakat</th>
                <th>Simpulan Performa Pencegahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($satker as $index => $m)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $m['nama_satker'] }}</td>
                    <td>{{ $m['pembinaan_mental'] }}</td>
                    <td>{{ $m['sosialisasi_antikorupsi'] }}</td>
                    <td>{{ $m['edukasi_pencegahan_pelanggaran_pegawai'] }}</td>
                    <td>{{ $m['penanganan_laporan_gratifikasi'] }}</td>
                    <td>{{ $m['pemantauan_perilaku_gaya_hidup_pegawai'] }}</td>
                    <td class="text-center fw-bold">{{ $m['total_nilai'] }}</td>
                    <td><strong>{{ $m['simpulan_performa_pencegahan'] }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="14" class="text-center text-muted">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Modal Detail Satker -->
<div class="modal fade" id="detailSatkerModal" tabindex="-1" aria-labelledby="detailSatkerLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="detailSatkerLabel">Detail Satker</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h4 id="satkerName" class="fw-bold mb-3"></h4>
          <table class="table table-bordered">
              <tbody>
                  <tr><th>Total Nilai</th><td id="totalNilai"></td></tr>
                  <tr><th>Kesimpulan</th><td id="kesimpulan"></td></tr>
              </tbody>
          </table>

          <div class="mt-4">
              <h5 class="text-center fw-bold">Performa Tiap Bidang</h5>
              <canvas id="chartBidang" height="200"></canvas>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
    const ctxTop = document.getElementById('chartTop10').getContext('2d');
    const ctxBottom = document.getElementById('chartBottom10').getContext('2d');
    const top10 = {!! json_encode($top10->values()) !!};
    const bottom10 = {!! json_encode($bottom10->values()) !!};
    let chartBidang;

    // Chart Satker Terbaik
    const chartTop = new Chart(ctxTop, {
        type: 'bar',
        data: {
            labels: top10.map(item => item.nama_satker),
            datasets: [{
                label: 'Total Nilai',
                data: top10.map(item => item.total_nilai),
                backgroundColor: 'rgba(40, 167, 69, 0.7)'
            }]
        },
        options: {
            onClick: (e, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const satker = top10[index];
                    showDetailSatker(satker.id);
                }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Chart Satker Terburuk
    const chartBottom = new Chart(ctxBottom, {
        type: 'bar',
        data: {
            labels: bottom10.map(item => item.nama_satker),
            datasets: [{
                label: 'Total Nilai',
                data: bottom10.map(item => item.total_nilai),
                backgroundColor: 'rgba(220, 53, 69, 0.7)'
            }]
        },
        options: {
            onClick: (e, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const satker = bottom10[index];
                    showDetailSatker(satker.id);
                }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    // AJAX ambil detail
    function showDetailSatker(id) {
        fetch(`/dashboard/satker/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('satkerName').innerText = data.nama_satker;
                document.getElementById('totalNilai').innerText = data.total_nilai;
                document.getElementById('kesimpulan').innerText = data.kesimpulan;

                const ctxBidang = document.getElementById('chartBidang').getContext('2d');
                const bidangLabels = Object.keys(data.bidang);
                const bidangValues = Object.values(data.bidang);

                if (chartBidang) chartBidang.destroy();
                chartBidang = new Chart(ctxBidang, {
                    type: 'radar',
                    data: {
                        labels: bidangLabels,
                        datasets: [{
                            label: 'Performa Bidang',
                            data: bidangValues,
                            backgroundColor: 'rgba(54, 162, 235, 0.3)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: { r: { beginAtZero: true, max: 100 } },
                        plugins: { legend: { display: false } }
                    }
                });

                const modal = new bootstrap.Modal(document.getElementById('detailSatkerModal'));
                modal.show();
            })
            .catch(err => console.error(err));
    }
</script>
@endsection
