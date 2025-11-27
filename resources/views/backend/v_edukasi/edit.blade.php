@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Edit Edukasi Pencegahan Pelanggaran Pegawai</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('edukasi.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ========================= --}}
            {{-- INFO PERIODE & SATKER --}}
            {{-- ========================= --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label><b>Periode</b></label>
                    <select name="periode" class="form-control" required>
                        <option value="Triwulan I"  {{ $data->periode == 'Triwulan I' ? 'selected' : '' }}>Triwulan I</option>
                        <option value="Triwulan II" {{ $data->periode == 'Triwulan II' ? 'selected' : '' }}>Triwulan II</option>
                        <option value="Triwulan III" {{ $data->periode == 'Triwulan III' ? 'selected' : '' }}>Triwulan III</option>
                        <option value="Triwulan IV" {{ $data->periode == 'Triwulan IV' ? 'selected' : '' }}>Triwulan IV</option>
                    </select>
                </div>

                <div class="col-md-8 mb-3">
                    <label><b>Satker</b></label>
                    <select name="satker_id" class="form-control" required>
                        @foreach($satker as $m)
                            <option value="{{ $m->id }}" 
                                {{ $data->satker_id == $m->id ? 'selected' : '' }}>
                                {{ $m->nama_satker }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            {{-- ========================= --}}
            {{-- TABEL 1: INDEKS PENILAIAN --}}
            {{-- ========================= --}}
            <h5 class="mb-2"><b>1. Indeks Penilaian Edukasi Pencegahan Pelanggaran Pegawai</b></h5>

            <table class="table table-bordered" style="background:#dbe5f1;">
                <thead class="text-center" style="background:#9cc2e5; font-weight:bold;">
                    <tr>
                        <th width="40%">Komponen</th>
                        <th width="20%">Indeks</th>
                        <th width="40%">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Pelaksanaan Dalam Setahun</td>
                        <td class="text-center">
                            <select name="indeks_pelaksanaan_dalam_setahun" id="pelaksanaan" class="form-control form-control-sm" required>
                                <option value="1" {{ $data->indeks_pelaksanaan_dalam_setahun == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $data->indeks_pelaksanaan_dalam_setahun == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $data->indeks_pelaksanaan_dalam_setahun == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $data->indeks_pelaksanaan_dalam_setahun == 4 ? 'selected' : '' }}>4</option>
                            </select>
                        </td>
                        <td>Jumlah kegiatan Edukasi Pencegahan Pelanggaran Pegawai dalam satu tahun</td>
                    </tr>
                    <tr>
                        <td>Peserta Kegiatan</td>
                        <td class="text-center">
                            <select name="indeks_peserta_kegiatan" id="peserta" class="form-control form-control-sm" required>
                                <option value="1" {{ $data->indeks_peserta_kegiatan == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $data->indeks_peserta_kegiatan == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $data->indeks_peserta_kegiatan == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $data->indeks_peserta_kegiatan == 4 ? 'selected' : '' }}>4</option>
                            </select>
                        </td>
                        <td>Persentase pegawai yang mengikuti kegiatan</td>
                    </tr>
                    <tr>
                        <td>Output Project Learning</td>
                        <td class="text-center">
                            <select name="output_project_learning" id="output" class="form-control form-control-sm" required>
                                <option value="1" {{ $data->output_project_learning == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $data->output_project_learning == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $data->output_project_learning == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $data->output_project_learning == 4 ? 'selected' : '' }}>4</option>
                            </select>
                        </td>
                        <td>Kualitas laporan project learning</td>
                    </tr>
                </tbody>
            </table>

            <hr>

            {{-- ========================= --}}
            {{-- TABEL 2: HASIL AKHIR --}}
            {{-- ========================= --}}
            <h5 class="mb-2"><b>2. Hasil Akhir Penilaian</b></h5>

            <table class="table table-bordered" style="background:#e2efd9;">
                <thead class="text-center" style="background:#a9d08e; font-weight:bold;">
                    <tr>
                        <th width="50%">Komponen</th>
                        <th width="50%">Nilai</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><b>Indeks Total</b></td>
                        <td>
                            <input type="text" id="indeks_total" name="indeks_total" class="form-control" value="{{ $data->indeks_total }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Kesimpulan</b></td>
                        <td>
                            <input type="text" id="kesimpulan" name="kesimpulan" class="form-control" value="{{ $data->kesimpulan }}" readonly>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr>

            {{-- ===================================== --}}
            {{-- 3. RENCANA KEGIATAN (TABEL BARU) --}}
            {{-- ===================================== --}}
            <h5 class="mb-3"><b>3. Rencana Kegiatan</b></h5>

            <table class="table table-bordered" style="background:#fff2cc;">
                <thead class="text-center" style="background:#ffe699; font-weight:bold;">
                    <tr>
                        <th>Jenis Kegiatan</th>
                        <th>Waktu</th>
                        <th>Tema</th>
                        <th>Tempat</th>
                        <th>Metode Pelaksanaan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><input type="text" name="jenis_kegiatan" class="form-control"></td>
                        <td><input type="text" name="waktu" class="form-control"></td>
                        <td><input type="text" name="tema" class="form-control"></td>
                        <td><input type="text" name="tempat" class="form-control"></td>
                        <td class="text-center">
                            <select name="metode_pelaksanaan" id="metode" class="form-control form-control-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">Sosialisasi/Seminar/Workshop (60%)</option>
                                <option value="2">Diseminasi (40%)</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr>

            {{-- ===================================== --}}
            {{-- 4. REALISASI PELAKSANAAN (TABEL BARU) --}}
            {{-- ===================================== --}}
            <h5 class="mb-3"><b>4. Realisasi Pelaksanaan Kegiatan</b></h5>

            <table class="table table-bordered" style="background:#e2efda;">
                <thead class="text-center" style="background:#c6e0b4; font-weight:bold;">
                    <tr>
                        <th>Narasumber</th>
                        <th>Jumlah Peserta</th>
                        <th>Kategori Peserta</th>
                        <th>Sasaran</th>
                        <th>Indeks Efektivitas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center">
                            <select name="narasumber" id="narasumber" class="form-control form-control-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">Pimpinan Unit Kerja (2)</option>
                                <option value="2">Selain Pimpinan Unit Kerja (1)</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <select name="jumlah_peserta" id="peserta" class="form-control form-control-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">1 (0-39%)</option>
                                <option value="2">2 (40-59%)</option>
                                <option value="3">3 (60-79%)</option>
                                <option value="4">4 (80-100%)</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <select name="kategori_peserta" id="kategori" class="form-control form-control-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">Stakeholder / Pengguna Layanan (2)</option>
                                <option value="2">Bukan Stakeholder / Pengguna Layanan (1)</option>
                            </select>
                        </td>
                        <td><input type="text" name="sasaran" class="form-control"></td>
                        <td><input type="text" name="indeks_efektivitas" class="form-control"></td>
                        <td><input type="text" name="keterangan" class="form-control"></td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('edukasi.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

{{-- ========================= --}}
{{-- SCRIPT AUTO HITUNG --}}
{{-- ========================= --}}
<script>
    function hitungTotal() {
        let p1 = parseInt(document.getElementById('pelaksanaan').value) || 0;
        let p2 = parseInt(document.getElementById('peserta').value) || 0;
        let p3 = parseInt(document.getElementById('output').value) || 0;

        let total = p1 + p2 + p3;
        document.getElementById('indeks_total').value = total;

        let kesimpulan = "";
        if (total < 3) kesimpulan = "Belum Memadai";
        else if (total < 5) kesimpulan = "Kurang";
        else if (total < 7) kesimpulan = "Baik";
        else kesimpulan = "Sangat Baik";

        document.getElementById('kesimpulan').value = kesimpulan;
    }

    document.querySelectorAll('select').forEach(el => {
        el.addEventListener('change', hitungTotal);
    });
</script>

@endsection
