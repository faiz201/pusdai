@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Pemantauan Zona Integritas DJBC</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Data
        </button>
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
        <tbody id="tabelData">
            @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->satker->nama_satker ?? '-' }}</td>
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

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-success text-white">
            <h5 class="modal-title">Tambah Data Pemantauan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form id="formTambah">
            @csrf
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Nama Satker</label>
                        <input type="text" name="nama_satker" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Tahun Predikat ZI WBK</label>
                        <input type="number" name="tahun_predikat" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Pemeliharaan WBK</label>
                        <select name="pemeliharaan_wbk" class="form-select">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Pencanangan WBBM</label>
                        <select name="pencanangan_wbbm" class="form-select">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Proses Penilaian WBBM</label>
                        <select name="proses_penilaian_wbbm" class="form-select">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Predikat WBBM</label>
                        <input type="text" name="predikat_wbbm" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

{{-- AJAX Tambah --}}
<script>
document.getElementById('formTambah').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);

    fetch("{{ route('pemantauan.store') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Data berhasil ditambahkan!');
            location.reload(); // refresh tabel
        } else {
            alert('Gagal menambahkan data!');
        }
    })
    .catch(err => console.error(err));
});
</script>
@endsection
