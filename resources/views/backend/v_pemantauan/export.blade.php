<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Satker</th>
            <th>Indeks Pelaksanaan Dalam Setahun</th>
            <th>Indeks Peserta Kegiatan</th>
            <th>Output Project Learning</th>
            <th>Indeks Total</th>
            <th>Kesimpulan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $row)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $row->satker->nama_satker ?? '-' }}</td>
                    <td class="text-center">{{ $row->indeks_pelaksanaan_dalam_setahun }}</td>
                    <td class="text-center">{{ $row->indeks_peserta_kegiatan }}</td>
                    <td class="text-center">{{ $row->output_project_learning }}</td>
                    <td class="text-center fw-bold">{{ $row->indeks_total }}</td>
                    <td class="text-center">
                        @if($row->kesimpulan == 'Sangat Baik')
                            <span class="badge bg-success">{{ $row->kesimpulan }}</span>
                        @elseif($row->kesimpulan == 'Baik')
                            <span class="badge bg-primary">{{ $row->kesimpulan }}</span>
                        @elseif($row->kesimpulan == 'Kurang')
                            <span class="badge bg-warning text-dark">{{ $row->kesimpulan }}</span>
                        @else
                            <span class="badge bg-danger">{{ $row->kesimpulan }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>