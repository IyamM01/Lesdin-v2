<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PKL Siswa Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3C5148;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .info-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .info-table td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .footer {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 8px 8px;
        }
        .highlight {
            background-color: #FEBC2F;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin: 0;">SMK Negeri 2 Depok Sleman</h2>
        <p style="margin: 5px 0 0 0;">Pendaftaran Praktek Kerja Lapangan (PKL)</p>
    </div>

    <div class="content">
        <p>Kepada Yth,<br>
        <strong>{{ $registration->mitra1->name ?? 'Perusahaan' }}</strong></p>

        <p>Dengan hormat,</p>

        <p>Kami dari <strong>SMK Negeri 2 Depok Sleman</strong> bermaksud menyampaikan bahwa terdapat siswa yang mendaftar untuk melaksanakan Praktek Kerja Lapangan (PKL) di perusahaan Bapak/Ibu.</p>

        <h3 style="color: #3C5148; border-bottom: 2px solid #3C5148; padding-bottom: 5px;">Data Siswa</h3>
        
        <table class="info-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>: {{ $registration->siswa->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>: {{ $registration->siswa->nis ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>: {{ $registration->siswa->jurusan->nama_jurusan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $registration->siswa->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>: {{ $registration->siswa->kontak ?? '-' }}</td>
            </tr>
        </table>

        <h3 style="color: #3C5148; border-bottom: 2px solid #3C5148; padding-bottom: 5px;">Informasi Perusahaan</h3>
        
        <table class="info-table">
            <tr>
                <td>Nama Perusahaan</td>
                <td>: {{ $registration->mitra1->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $registration->mitra1->alamat ?? '-' }}</td>
            </tr>
        </table>

        <h3 style="color: #3C5148; border-bottom: 2px solid #3C5148; padding-bottom: 5px;">Status Pendaftaran</h3>
        
        <p>Status saat ini: <span class="highlight">{{ strtoupper($registration->status) }}</span></p>
        
        <p style="background-color: #fff3cd; padding: 15px; border-left: 4px solid #FEBC2F; margin: 20px 0;">
            <strong>Catatan:</strong><br>
            Mohon untuk dapat mempertimbangkan pendaftaran siswa kami. Untuk informasi lebih lanjut atau konfirmasi, Bapak/Ibu dapat menghubungi pihak sekolah atau langsung menghubungi siswa yang bersangkutan.
        </p>

        <p>Demikian surat elektronik ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>

        <p style="margin-top: 30px;">
            Hormat kami,<br>
            <strong>SMK Negeri 2 Depok Sleman</strong><br>
            Panitia PKL
        </p>
    </div>

    <div class="footer">
        <p style="margin: 0;">Email ini dikirim secara otomatis dari sistem PKL SMK N 2 Depok Sleman</p>
        <p style="margin: 5px 0 0 0;">Jl. STM Pembangunan, Mrican, Caturtunggal, Kec. Depok, Kabupaten Sleman</p>
    </div>
</body>
</html>
