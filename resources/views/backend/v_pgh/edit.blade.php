@extends('backend.v_layouts.app')

@section('content')
<div class="section-header">
    <h1>Edit Data Pemantauan Perilaku dan Gaya Hidup (PGH)</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pgh.update', $pgh->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="satker_id" class="form-label">Nama Satker</label>
                    <select name="satker_id" id="satker_id" class="form-control @error('satker_id') is-invalid @enderror">
                        <option value="">-- Pilih Satker --</option>
                        @foreach($satker as $m)
                            <option value="{{ $m->id }}" {{ old('satker_id', $pgh->satker_id) == $m->id ? 'selected' : '' }}>
                                {{ $m->nama_satker }}
                            </option>
                        @endforeach
                    </select>
                    @error('satker_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dasar_pelaksanaan" class="form-label">Dasar Pelaksanaan</label>
                    <input type="text" name="dasar_pelaksanaan" id="dasar_pelaksanaan"
                           class="form-control @error('dasar_pelaksanaan') is-invalid @enderror"
                           value="{{ old('dasar_pelaksanaan', $pgh->dasar_pelaksanaan) }}">
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
                           value="{{ old('objek_pemantauan', $pgh->objek_pemantauan) }}">
                    @error('objek_pemantauan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_dugaan" class="form-label">Jenis Dugaan PGH yang Tidak Patut</label>
                    <input type="text" name="jenis_dugaan" id="jenis_dugaan"
                           class="form-control @error('jenis_dugaan') is-invalid @enderror"
                           value="{{ old('jenis_dugaan', $pgh->jenis_dugaan) }}">
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
                        <option value="Selesai" {{ old('penyelesaian', $pgh->penyelesaian) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Proses" {{ old('penyelesaian', $pgh->penyelesaian) == 'Proses' ? 'selected' : '' }}>Proses</option>
                    </select>
                    @error('penyelesaian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="status_terbukti" class="form-label">Terbukti / Tidak Terbukti</label>
                    <select name="status_terbukti" id="status_terbukti" class="form-control @error('status_terbukti') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Terbukti" {{ old('terbukti', $pgh->terbukti) == 'Terbukti' ? 'selected' : '' }}>Terbukti</option>
                        <option value="Tidak Terbukti" {{ old('terbukti', $pgh->terbukti) == 'Tidak Terbukti' ? 'selected' : '' }}>Tidak Terbukti</option>
                    </select>
                    @error('terbukti')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="laporan_hasil" class="form-label">Laporan Hasil Pemantauan</label>
                    <input type="text" name="laporan_hasil" id="laporan_hasil"
                           class="form-control @error('laporan_hasil') is-invalid @enderror"
                           value="{{ old('laporan_hasil', $pgh->laporan_hasil) }}">
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
                           value="{{ old('dasar_rekomendasi', $pgh->dasar_rekomendasi) }}">
                    @error('dasar_rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_rekomendasi" class="form-label">Jenis Rekomendasi</label>
                    <input type="text" name="jenis_rekomendasi" id="jenis_rekomendasi"
                           class="form-control @error('jenis_rekomendasi') is-invalid @enderror"
                           value="{{ old('jenis_rekomendasi', $pgh->jenis_rekomendasi) }}">
                    @error('jenis_rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status_tindak_lanjut" class="form-label">Status Tindak Lanjut</label>
                    <select name="status_tindak_lanjut" id="status_tindak_lanjut" class="form-control @error('status_tindak_lanjut') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Belum TL" {{ old('status_tindak_lanjut', $pgh->status_tindak_lanjut) == 'Belum TL' ? 'selected' : '' }}>Belum TL</option>
                        <option value="Proses TL" {{ old('status_tindak_lanjut', $pgh->status_tindak_lanjut) == 'Proses TL' ? 'selected' : '' }}>Proses TL</option>
                        <option value="Selesai TL" {{ old('status_tindak_lanjut', $pgh->status_tindak_lanjut) == 'Selesai TL' ? 'selected' : '' }}>Selesai TL</option>
                    </select>
                    @error('status_tindaklanjut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dasar_tindak_lanjut" class="form-label">Dasar Tindak Lanjut</label>
                    <input type="text" name="dasar_tindak_lanjut" id="dasar_tindak_lanjut"
                           class="form-control @error('dasar_tindak_lanjut') is-invalid @enderror"
                           value="{{ old('dasar_tindak_lanjut', $pgh->dasar_tindak_lanjut) }}">
                    @error('dasar_tindak_lanjut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                          class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $pgh->keterangan) }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pgh.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
