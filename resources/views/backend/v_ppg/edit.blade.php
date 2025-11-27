@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Edit Laporan PPG (Penanganan Laporan Penanganan)</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('ppg.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

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

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor SIG</label>
                    <input type="text" name="nomor_sig" value="{{ $data->nomor_sig }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" value="{{ $data->jenis }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Objek Penanganan</label>
                    <input type="text" name="objek_penanganan" value="{{ $data->objek_penanganan }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Bentuk Pemberian</label>
                    <input type="text" name="bentuk_pemberian" value="{{ $data->bentuk_pemberian }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nilai Taksiran</label>
                    <input type="number" name="nilai_taksiran" value="{{ $data->nilai_taksiran }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Pemberi</label>
                    <input type="text" name="kategori_pemberi" value="{{ $data->kategori_pemberi }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Proses Bisnis Terkait</label>
                    <input type="text" name="proses_bisnis" value="{{ $data->proses_bisnis }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Penetapan oleh KPK</label>
                    <input type="text" name="status_kpk" value="{{ $data->status_kpk }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor SK Penetapan</label>
                    <input type="text" name="nomor_sk" value="{{ $data->nomor_sk }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tindak Lanjut</label>
                    <input type="text" name="tindak_lanjut" value="{{ $data->tindak_lanjut }}" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control">{{ $data->keterangan }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('ppg.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
