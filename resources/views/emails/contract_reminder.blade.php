<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengingat Pembayaran Kontrak</title>
</head>
<body>
    <p>Yth. {{ $tenant->name }},</p>

    <p>
        Kami ingin mengingatkan bahwa kontrak Anda akan jatuh tempo pada
        <strong>{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</strong>.
    </p>

    <p>
        Mohon segera melakukan pembayaran <strong>sebelum 1 minggu dari tanggal jatuh tempo</strong>.
    </p>

    <p>Terima kasih atas perhatiannya.</p>

    <br>
    <p>Salam,</p>
    <p><strong>Admin PT Bejibun</strong></p>
</body>
</html>
