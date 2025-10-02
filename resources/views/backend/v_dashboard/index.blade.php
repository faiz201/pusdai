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
            @php
            $opsi = [
                4 => 'Sangat Baik (4)',
                3 => 'Baik (3)',
                2 => 'Cukup (2)',
                1 => 'Belum Memadai (1)',
            ];
            @endphp

            @foreach($satker as $index => $m)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $m->satuan_kerja }}</td>

                {{-- dropdown pilihan --}}
                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->pembinaan_mental == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->sosialisasi_antikorupsi == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->edukasi_pencegahan == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->pengendalian_gratifikasi == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->pemantauan_perilaku_dan_gaya_hidup == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->pemantauan_lhk == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->pelaksanaan_monev_zi == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->analisis_data_informasi_pegawai == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->penanganan_hasil_survey == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control">
                        @foreach($opsi as $key => $val)
                            <option value="{{ $key }}" {{ $m->penanganan_pengaduan_masyarakat == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>{{ $m->simpulan_performa_pencegahan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
