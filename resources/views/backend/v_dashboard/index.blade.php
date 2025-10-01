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
            <input type="text" name="unit" class="form-control" placeholder="Satuan Kerja" value="{{ request('unit') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    {{-- Export Buttons --}}
    <form method="GET" action="{{ route('dashboard.export.excel') }}" class="d-inline">
        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
        <input type="hidden" name="unit" value="{{ request('unit') }}">
        <button type="submit" class="btn btn-success mb-2">Export Excel</button>
    </form>

    <form method="GET" action="{{ route('dashboard.export.csv') }}" class="d-inline">
        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
        <input type="hidden" name="unit" value="{{ request('unit') }}">
        <button type="submit" class="btn btn-info mb-2">Export CSV</button>
    </form>

    {{-- Table --}}
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Satuan Kerja</th>
                <th>Pembinaan Mental</th>
                <th>Sosialisasi Antikorupsi</th>
                <th>Edukasi Pencegahan</th>
                <th>Pengendalian Gratifikasi</th>
                <th>Pemantauan Perilaku dan Gaya Hidup</th>
                <th>Pemantauan LHK</th>
                <th>Pelaksanaan Monev ZI</th>
                <th>Analisis Data Informasi Pegawai</th>
                <th>Penanganan Hasil Survey</th>
                <th>Penanganan Pengaduan Masyarakat</th>
                <th>Simpulan Performa Pencegahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($satker as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->seksi }}</td>
                    <td>{{ $row->pembinaan_mental }}</td>
                    <td>{{ $row->sosialisasi_antikorupsi }}</td>
                    <td>{{ $row->edukasi_pencegahan }}</td>
                    <td>{{ $row->pengendalian_gratifikasi }}</td>
                    <td>{{ $row->pemantauan_perilaku }}</td>
                    <td>{{ $row->pemantauan_lhk }}</td>
                    <td>{{ $row->pelaksanaan_monev }}</td>
                    <td>{{ $row->analisis_data }}</td>
                    <td>{{ $row->penanganan_survey }}</td>
                    <td>{{ $row->penanganan_pengaduan }}</td>
                    <td>{{ $row->simpulan_performa }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
