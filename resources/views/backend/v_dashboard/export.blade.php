<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Satuan Kerja</th>
            <th>Pembentukan UPG</th>
            <th>Identifikasi Titik Rawan</th>
            <th>Pemantauan Titik Rawan</th>
            <th>Penyebaran Pesan Anti Gratifikasi</th>
            <th>Pembinaan UPG Tk. I</th>
            <th>Pembinaan UPG Tk. II</th>
            <th>Pembinaan UPG Tk. III</th>
            <th>Sosialisasi Antikorupsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->seksi }}</td>
            <td>{{ $row->pembentukan_upg }}</td>
            <td>{{ $row->identifikasi_rawan }}</td>
            <td>{{ $row->pemantauan_rawan }}</td>
            <td>{{ $row->penyebaran_pesan }}</td>
            <td>{{ $row->pembinaan_tk1 }}</td>
            <td>{{ $row->pembinaan_tk2 }}</td>
            <td>{{ $row->pembinaan_tk3 }}</td>
            <td>{{ $row->sosialisasi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>