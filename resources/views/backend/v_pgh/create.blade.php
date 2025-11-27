@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Tambah Data Pemantauan Perilaku dan Gaya Hidup (PGH)</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pgh.store') }}" method="POST">
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

                <div class="col-md-6 mb-3">
                    <label for="dasar_pelaksanaan" class="form-label">Dasar Pelaksanaan</label>
                    <input type="text" name="dasar_pelaksanaan" id="dasar_pelaksanaan" 
                           class="form-control @error('dasar_pelaksanaan') is-invalid @enderror"
                           value="{{ old('dasar_pelaksanaan') }}">
                    @error('dasar_pelaksanaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="objek_pemantauan" class="form-label">Objek Pemantauan</label>
                    <input type="text" name="objek_pemantauan" id="objek_pemantauan" 
                           class="form-control @error('objek_pemantauan') is-invalid @enderror"
                           value="{{ old('objek_pemantauan') }}">
                    @error('objek_pemantauan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_dugaan" class="form-label">Jenis Dugaan PGH yang Tidak Patut</label>
                    <input type="text" name="jenis_dugaan" id="jenis_dugaan" 
                           class="form-control @error('jenis_dugaan') is-invalid @enderror"
                           value="{{ old('jenis_dugaan') }}">
                    @error('jenis_dugaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="penyelesaian" class="form-label">Penyelesaian</label>
                    <select name="penyelesaian" id="penyelesaian" class="form-control @error('penyelesaian') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Selesai" {{ old('penyelesaian') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Proses" {{ old('penyelesaian') == 'Proses' ? 'selected' : '' }}>Proses</option>
                    </select>
                    @error('penyelesaian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="status_terbukti" class="form-label">Terbukti / Tidak Terbukti</label>
                    <select name="status_terbukti" id="status_terbukti" class="form-control @error('status_terbukti') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Terbukti" {{ old('terbukti') == 'Terbukti' ? 'selected' : '' }}>Terbukti</option>
                        <option value="Tidak Terbukti" {{ old('terbukti') == 'Tidak Terbukti' ? 'selected' : '' }}>Tidak Terbukti</option>
                    </select>
                    @error('terbukti')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="laporan_hasil" class="form-label">Laporan Hasil Pemantauan</label>
                    <input type="text" name="laporan_hasil" id="laporan_hasil" 
                           class="form-control @error('laporan_hasil') is-invalid @enderror"
                           value="{{ old('laporan_hasil') }}">
                    @error('laporan_hasil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dasar_rekomendasi" class="form-label">Dasar Rekomendasi</label>
                    <input type="text" name="dasar_rekomendasi" id="dasar_rekomendasi" 
                           class="form-control @error('dasar_rekomendasi') is-invalid @enderror"
                           value="{{ old('dasar_rekomendasi') }}">
                    @error('dasar_rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_rekomendasi" class="form-label">Jenis Rekomendasi</label>
                    <input type="text" name="jenis_rekomendasi" id="jenis_rekomendasi" 
                           class="form-control @error('jenis_rekomendasi') is-invalid @enderror"
                           value="{{ old('jenis_rekomendasi') }}">
                    @error('jenis_rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status_tindaklanjut" class="form-label">Status Tindak Lanjut</label>
                    <select name="status_tindak_lanjut" id="status_tindak_lanjut" class="form-control @error('status_tindak_lanjut') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Belum TL" {{ old('status_tindak_lanjut') == 'Belum TL' ? 'selected' : '' }}>Belum TL</option>
                        <option value="Proses TL" {{ old('status_tindak_lanjut') == 'Proses TL' ? 'selected' : '' }}>Proses TL</option>
                        <option value="Selesai TL" {{ old('status_tindak_lanjut') == 'Selesai TL' ? 'selected' : '' }}>Selesai TL</option>
                    </select>
                    @error('status_tindaklanjut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dasar_tindak_lanjut" class="form-label">Dasar Tindak Lanjut</label>
                    <input type="text" name="dasar_tindak_lanjut" id="dasar_tindak_lanjut" 
                           class="form-control @error('dasar_tindak_lanjut') is-invalid @enderror"
                           value="{{ old('dasar_tindak_lanjut') }}">
                    @error('dasar_tindak_lanjut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3" 
                          class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pgh.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
