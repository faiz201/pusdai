<table>
    <thead>
        <tr>
            <th>No</th>
                <th>Satuan Kerja</th>
                <th>Konteks</th>
                <th>Pembinaan Mental</th>
                <th>Sosialisasi Antikorupsi</th>
                <th>Edukasi Pencegahan</th>
                <th>Pengendalian Gratifikasi</th>
                <th>Pemantauan Perilaku dan Gaya Hidup</th>
                <th>Pemantauan LHK</th>
                <th>Pelaksanaan Monev ZI</th>
                <th>Analisis Data Informasi Pegawai</th>
                <th>Penanganan Hasil Survey</th>
                <th>Penanganan Pengaduan Masyarakat</th>
                <th>Simpulan Performa Pencegahan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $row)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $row->nama_satker }}</td>
                    <td>{{ $row->pembentukan_upg }}</td>
                    <td>{{ $row->identifikasi_titik_rawan }}</td>
                    <td>{{ $row->pemantauan_titik_rawan }}</td>
                    <td>{{ $row->penyebaran_pesan }}</td>
                    <td>{{ $row->pembinaan_upg_i }}</td>
                    <td>{{ $row->pembinaan_upg_ii }}</td>
                    <td>{{ $row->pembinaan_upg_iii }}</td>
                    <td>{{ $row->pembinaan_upg_iv }}</td>
                </tr>
            @endforeach
    </tbody>
</table>