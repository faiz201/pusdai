@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Nilai Realisasi PPG</h4>

    <form method="GET" action="{{ route('dashboard') }}" class="d-flex mb-3">
        <select name="tahun" class="form-control me-2">
            <option value="">-- Filter Tahun --</option>
            @for($i=2020; $i<=date('Y')+1; $i++)
                <option value="{{ $i }}" {{ request('tahun')==$i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <input type="text" name="unit" placeholder="Filter Unit" class="form-control me-2" value="{{ request('seksi') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="mb-3">
        <a href="{{ route('dashboard.export.excel', request()->all()) }}" class="btn btn-success">Export Excel</a>
        <a href="{{ route('dashboard.export.csv', request()->all()) }}" class="btn btn-secondary">Export CSV</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Satuan Kerja</th>
                <th>Pembentukan UPG</th>
                <th>Identifikasi Titik Rawan</th>
                <th>Pemantauan Titik Rawan</th>
                <th>Penyebaran Pesan Anti Gratifikasi</th>
                <th>Pembinaan UPG Tk. I</th>
                <th>Pembinaan UPG Tk. II</th>
                <th>Pembinaan UPG Tk. III</th>
                <th>Sosialisasi Antikorupsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->seksi }}</td>
                    <td>{{ $row->pembentukan_upg }}</td>
                    <td>{{ $row->identifikasi_rawan }}</td>
                    <td>{{ $row->pemantauan_rawan }}</td>
                    <td>{{ $row->penyebaran_pesan }}</td>
                    <td>{{ $row->pembinaan_tk1 }}</td>
                    <td>{{ $row->pembinaan_tk2 }}</td>
                    <td>{{ $row->pembinaan_tk3 }}</td>
                    <td>{{ $row->sosialisasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection