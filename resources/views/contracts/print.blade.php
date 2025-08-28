<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Contracts</title>
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

    <h2>Daftar Contracts</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Contract No</th>
                <th>Property Unit</th>
                <th>Tenant</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Monthly Rent</th>
                <th>Deposit</th>
                <th>Payment Due</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts as $contract)
                <tr>
                    <td>{{ $contract->id }}</td>
                    <td hidden>{{ $contract->contract_number ?? '-' }}</td>
                    <td>{{ $contract->propertyUnit->unit_code ?? '-' }}
                        <br>
                        <small>{{ $contract->propertyUnit->name ?? '-' }}</small>
                    </td>
                    <td>{{ $contract->tenant->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($contract->end_date)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($contract->monthly_rent, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($contract->deposit_amount, 0, ',', '.') }}</td>
                    <td>{{ $contract->payment_due_day }}</td>
                    <td>{{ ucfirst($contract->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>
