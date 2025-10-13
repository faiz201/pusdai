<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            margin: 20px;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
        }
        h4 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background: #f2f2f2;
            text-align: center;
        }
        th, td {
            padding: 6px;
        }
        .foto {
            text-align: center;
        }
        .foto img {
            width: 100px;
            height: auto;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 40px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        .footer div {
            text-align: center;
            margin-right: 50px;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>LAPORAN MONITORING</h2>
    <h4>Periode: {{ $periode ?? '-' }}</h4>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Judul Laporan</th>
                <th>Seksi</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $item->judul_laporan }}</td>
                    <td>{{ $item->seksi->seksi ?? '-' }}</td>
                    <td class="text-center">{{ ucfirst($item->status) }}</td>
                    <td class="text-center">{{ $item->updated_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div>
            <p>.................., {{ now()->format('d F Y') }}</p>
            <p><strong>Mengetahui,</strong></p>
            <br><br><br>
            <p>________________________</p>
        </div>
    </div>

</body>
</html>