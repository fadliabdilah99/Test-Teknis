<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #1f355e;
            color: white;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <h2 style="text-align: center;">Data Pegawai</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat<br>Lahir</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>L/P</th>
                <th>Gol</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Tempat<br>Tugas</th>
                <th>Agama</th>
                <th>Unit<br>Kerja</th>
                <th>No. HP</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawais as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->nip }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tempat_lahir }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->tgl_lahir }}</td>
                <td>{{ $p->jk }}</td>
                <td>{{ $p->golongan->gol ?? '-' }}</td>
                <td>{{ $p->eselon->eselon ?? '-' }}</td>
                <td>{{ $p->jabatan->jabatan ?? '-' }}</td>
                <td>{{ $p->tempat_tugas }}</td>
                <td>{{ $p->agama->agama ?? '-' }}</td>
                <td>{{ $p->unitKerja->nama ?? '-' }}</td>
                <td>{{ $p->no_hp }}</td>
                <td>{{ $p->npwp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
