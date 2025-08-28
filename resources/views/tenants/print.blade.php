<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tenant</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px;
            padding: 5px;
        }

        td {
            padding: 5px;
            font-size: 11px;
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <h2>Daftar Penyewa (Tenant)</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Status Perkawinan</th>
                <th>Alamat Rumah Asal</th>
                <th>No. Telp/HP</th>
                <th>No. Kontak Darurat</th>
                <th>Tanggal Mulai Huni/Sewa</th>
                <th>No. KTP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->id }}</td>
                    <td>{{ $tenant->name }}</td>
                    <td>{{ $tenant->gender }}</td>
                    <td>{{ $tenant->religion ?? '-' }}</td>
                    <td>{{ $tenant->occupation ?? '-' }}</td>
                    <td>{{ $tenant->marital_status ?? '-' }}</td>
                    <td>{{ $tenant->origin_address ?? '-' }}</td>
                    <td>{{ $tenant->phone }}</td>
                    <td>
                        @if($tenant->emergency_contact)
                            {{ $tenant->emergency_contact }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $tenant->rental_start_date ? \Carbon\Carbon::parse($tenant->rental_start_date)->format('d-m-Y') : '-' }}
                    </td>
                    <td>{{ $tenant->id_card_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif