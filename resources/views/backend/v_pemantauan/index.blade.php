@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Pemantauan Zona Integritas DJBC</h4>
        <a href="{{ route('pemantauan.create') }}" class="btn btn-success">+ Tambah Data</a>
    </div>

    {{-- Filter Tahun/Bulan --}}
    <form method="GET" action="{{ route('pemantauan.index') }}" class="d-flex mb-3">
        <select name="tahun" class="form-select me-2" style="width: 200px;">
            <option value="">-- Pilih Tahun --</option>
            @foreach($tahunList as $t)
                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
        </select>

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
                    <td>{{ $row->satker->nama ?? '-' }}</td>
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
</div>
@endsection
