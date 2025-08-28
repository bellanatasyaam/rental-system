<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tenant</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            margin: 20px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            width: 35%;
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h2>Detail Penyewa</h2>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $tenant->id }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $tenant->name }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $tenant->gender }}</td>
        </tr>
        <tr>
            <th>Agama</th>
            <td>{{ $tenant->religion ?? '-' }}</td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td>{{ $tenant->occupation ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status Perkawinan</th>
            <td>{{ $tenant->marital_status ?? '-' }}</td>
        </tr>
        <tr>
            <th>Alamat Rumah Asal</th>
            <td>{{ $tenant->origin_address ?? '-' }}</td>
        </tr>
        <tr>
            <th>No. Telp / HP</th>
            <td>{{ $tenant->phone ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kontak Darurat</th>
            <td>{{ $tenant->emergency_contact ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Mulai Huni / Sewa</th>
            <td>{{ $tenant->rental_start_date ? \Carbon\Carbon::parse($tenant->rental_start_date)->format('d-m-Y') : '-' }}</td>
        </tr>
        <tr>
            <th>No. KTP</th>
            <td>{{ $tenant->id_card_number ?? '-' }}</td>
        </tr>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>
