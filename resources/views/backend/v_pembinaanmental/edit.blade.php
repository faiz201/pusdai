@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Edit Pembinaan Mental</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('pembinaanmental.update', $data->id) }}" method="POST">
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
            <h5 class="mb-2"><b>1. Indeks Penilaian Pembinaan Mental</b></h5>

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
                                <option value="1" {{ $data->indeks_pelaksanaan_dalam_setahun == 1 ? 'selected' : '' }}>1 (1 Kegiatan/lebih dengan 1 Bidang berbeda)</option>
                                <option value="2" {{ $data->indeks_pelaksanaan_dalam_setahun == 2 ? 'selected' : '' }}>2 (2 Kegiatan/lebih dengan 2 Bidang berbeda)</option>
                                <option value="3" {{ $data->indeks_pelaksanaan_dalam_setahun == 3 ? 'selected' : '' }}>3 (3 Kegiatan/lebih dengan 3 Bidang berbeda)</option>
                                <option value="4" {{ $data->indeks_pelaksanaan_dalam_setahun == 4 ? 'selected' : '' }}>4 (4 Kegiatan/lebih dengan 4 Bidang berbeda)</option>
                            </select>
                        </td>
                        <td>Jumlah kegiatan pembinaan mental dalam satu tahun</td>
                    </tr>
                    <tr>
                        <td>Peserta Kegiatan</td>
                        <td class="text-center">
                            <select name="indeks_peserta_kegiatan" id="peserta" class="form-control form-control-sm" required>
                                <option value="1" {{ $data->indeks_peserta_kegiatan == 1 ? 'selected' : '' }}>1 (0-39%)</option>
                                <option value="2" {{ $data->indeks_peserta_kegiatan == 2 ? 'selected' : '' }}>2 (40-59%)</option>
                                <option value="3" {{ $data->indeks_peserta_kegiatan == 3 ? 'selected' : '' }}>3 (60-79%)</option>
                                <option value="4" {{ $data->indeks_peserta_kegiatan == 4 ? 'selected' : '' }}>4 (80-100%)</option>
                            </select>
                        </td>
                        <td>Persentase pegawai yang mengikuti kegiatan</td>
                    </tr>
                    <tr>
                        <td>Output Project Learning</td>
                        <td class="text-center">
                            <select name="output_project_learning" id="output" class="form-control form-control-sm" required>
                                <option value="1" {{ $data->output_project_learning == 1 ? 'selected' : '' }}>1 (Belum Memadai)</option>
                                <option value="2" {{ $data->output_project_learning == 2 ? 'selected' : '' }}>2 (Kurang)</option>
                                <option value="3" {{ $data->output_project_learning == 3 ? 'selected' : '' }}>3 (Baik)</option>
                                <option value="4" {{ $data->output_project_learning == 4 ? 'selected' : '' }}>4 (Sangat Baik)</option>
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
                        <th>Program / Kegiatan</th>
                        <th>Ruang Lingkup</th>
                        <th>Waktu</th>
                        <th>Tema</th>
                        <th>Tempat</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><input type="text" name="program_kegiatan" class="form-control"></td>
                        <td><input type="text" name="ruang_lingkup" class="form-control"></td>
                        <td><input type="text" name="waktu" class="form-control"></td>
                        <td><input type="text" name="tema" class="form-control"></td>
                        <td><input type="text" name="tempat" class="form-control"></td>
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
                        <th>Waktu Pelaksanaan</th>
                        <th>Peran Pejabat Administrator</th>
                        <th>Narasi Singkat Peran</th>
                        <th>Jumlah Peserta</th>
                        <th>Output / Manfaat</th>
                        <th>Link Dokumentasi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><input type="text" name="waktu_pelaksanaan" class="form-control"></td>
                        <td><input type="text" name="peran_pejabat_administrator" class="form-control"></td>
                        <td><textarea name="narasi_singkat_peran" class="form-control" rows="2"></textarea></td>
                        <td><input type="number" name="jumlah_peserta" class="form-control"></td>
                        <td><input type="text" name="output_manfaat" class="form-control"></td>
                        <td><input type="text" name="link_dokumentasi" class="form-control" placeholder="https://..."></td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pembinaanmental.index') }}" class="btn btn-secondary">Kembali</a>

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
