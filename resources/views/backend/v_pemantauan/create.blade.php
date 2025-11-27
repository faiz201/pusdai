@extends('backend.v_layouts.app')

@section('content')
<h4 class="mb-3">Tambah Data Pemantauan Zona Integritas DJBC</h4>

<form action="{{ route('pemantauan.store') }}" method="POST">
    @csrf

    {{-- ========================= --}}
    {{-- INFO PERIODE & SATKER --}}
    {{-- ========================= --}}
        <div class="row">
            <div class="col-md-8 mb-3">
                <label><b>Satker</b></label>
                <select name="satker_id" class="form-control" required>
                    <option value="">-- Pilih Satker --</option>
                    @foreach($satker as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_satker }}</option>
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
                            <option value="">-- Pilih --</option>
                            <option value="1">1 (1 Kegiatan/lebih dengan 1 Bidang berbeda)</option>
                            <option value="2">2 (2 Kegiatan/lebih dengan 2 Bidang berbeda)</option>
                            <option value="3">3 (3 Kegiatan/lebih dengan 3 Bidang berbeda)</option>
                            <option value="4">4 (4 Kegiatan/lebih dengan 4 Bidang berbeda)</option>
                        </select>
                    </td>
                    <td>Jumlah kegiatan pembinaan mental dalam satu tahun</td>
                </tr>
                <tr>
                    <td>Peserta Kegiatan</td>
                    <td class="text-center">
                        <select name="indeks_peserta_kegiatan" id="peserta" class="form-control form-control-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">1 (0-39%)</option>
                            <option value="2">2 (40-59%)</option>
                            <option value="3">3 (60-79%)</option>
                            <option value="4">4 (80-100%)</option>
                        </select>
                    </td>
                    <td>Persentase pegawai yang mengikuti kegiatan</td>
                </tr>
                <tr>
                    <td>Output Project Learning</td>
                    <td class="text-center">
                        <select name="output_project_learning" id="output" class="form-control form-control-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">1 (Belum Memadai)</option>
                            <option value="2">2 (Kurang)</option>
                            <option value="3">3 (Baik)</option>
                            <option value="4">4 (Sangat Baik)</option>
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
                        <input type="text" id="indeks_total" name="indeks_total" class="form-control" readonly>
                    </td>
                </tr>
                <tr>
                    <td><b>Kesimpulan</b></td>
                    <td>
                        <input type="text" id="kesimpulan" name="kesimpulan" class="form-control" readonly>
                    </td>
                </tr>
            </tbody>
        </table>

    <div class="mb-3">
        <label>Tahun Predikat ZI WBK</label>
        <input type="text" name="tahun_predikat" class="form-control" placeholder="Contoh: 2023">
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="pemeliharaan_wbk" value="1" class="form-check-input">
        <label class="form-check-label">Pemeliharaan WBK</label>
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="pencanangan_wbbm" value="1" class="form-check-input">
        <label class="form-check-label">Pencanangan WBBM</label>
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="proses_penilaian_wbbm" value="1" class="form-check-input">
        <label class="form-check-label">Proses Penilaian WBBM</label>
    </div>

    <div class="mb-3">
        <label>Predikat WBBM</label>
        <input type="text" name="predikat_wbbm" class="form-control" placeholder="Contoh: WBBM / WBK">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('pemantauan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
