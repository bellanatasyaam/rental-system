<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Diri Penghuni Kost</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0 50px; /* kanan kiri 40px */
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td {
            padding: 5px;
            vertical-align: top;
        }
        .signature {
            margin-top: 40px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="title">
        FORM DATA DIRI PENGHUNI KOST TAHUN {{ date('Y') }}
    </div>

    <p style="text-align: justify;">Petunjuk Pelaksanaan Penghuni Rumah Kost Ruko Manalagi Blok B1 Dan B2, untuk 
        memudahkan pendataan administrasi data diri penghuni Kost, dimohon untuk mengisi form
        Data Diri terbaru dalam mendukung tata tertib Penghunian Rumah Kost:</p>

    <table>
        <tr>
            <td>1. Nama</td>
            <td>: {{ $contract->tenant->name ?? '-' }}</td>
        </tr>
        <tr>
            <td>2. Jenis Kelamin</td>
            <td>: {{ ucfirst($contract->tenant->gender ?? '-') }}</td>
        </tr>
        <tr>
            <td>3. Agama</td>
            <td>: {{ ucfirst($contract->tenant->religion ?? '-') }}</td>
        </tr>
        <tr>
            <td>4. Kamar / Lantai / AC</td>
            <td>: {{ $contract->propertyUnit->unit_code ?? '-' }} /
                  {{ $contract->propertyUnit->floor ?? '-' }} /
                  {{ $contract->propertyUnit->ac == 1 ? 'AC' : 'Non AC' }}</td>
        </tr>
        <tr>
            <td>5. Pekerjaan</td>
            <td>: {{ $contract->tenant->occupation ?? '-' }}</td>
        </tr>
        <tr>
            <td>6. Status Perkawinan</td>
            <td>: {{ ucfirst($contract->tenant->marital_status ?? '-') }}</td>
        </tr>
        <tr>
            <td>7. Alamat Asal</td>
            <td>: {{ $contract->tenant->origin_address ?? '-' }}</td>
        </tr>
        <tr>
            <td>8. No. Telp / HP</td>
            <td>: {{ $contract->tenant->phone ?? '-' }}</td>
        </tr>
        <tr>
            <td>9. Kontak Darurat - Nama & Hubungan</td>
            <td>: {{ $contract->tenant->emergency_contact ?? '-' }}</td>
        </tr>
        <tr>
            <td>10. Tanggal Mulai Huni</td>
            <td>: {{ \Carbon\Carbon::parse($contract->tenant->rental_start_date)->format('d-m-Y') }}</td>
        </tr>
    </table>

        <p style="text-align: justify;">Demikian informasi data pribadi disampaikan dan ditulis adalah benar sesuai dengan fakta dan dapat dipertanggungjawabkan kebenarannya dan dengan penuh kesadaran tanpa ada paksaan dari pihak manapun.</p>

         <strong><p style="text-align: justify;"><u>Catatan:</u></p></strong>
            Penghuni/Penyewa kost wajib menginformasikan apabila mengubah identitas data diri.</p>

    <div class="signature">
        <p>Telah Dibaca dan Disetujui oleh,<br><br><br><br>
        <strong><u>{{ $contract->tenant->name ?? '_________________' }}</u></strong><br><br><br>
        <p style="text-align: center;"> Terima kasih atas perhatian dan kerjasamanya.</p>
         </p>
    </div>

</body>
</html>
