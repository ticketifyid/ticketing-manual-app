<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran Disetujui - Tiket Aktif</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            background: #28a745;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
        }

        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Pembayaran Disetujui!</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $buyer->nama_lengkap }}</strong></p>
            <p>Selamat! Pembayaran Anda telah disetujui dan tiket Anda sudah aktif.</p>
            <ul>
                <li><strong>Order ID:</strong> {{ $buyer->external_id }}</li>
                <li><strong>Tiket:</strong> {{ $buyer->ticket->name }}</li>
                <li><strong>Nama BIB:</strong> {{ $buyer->nama_bib }}</li>
                <li><strong>Ukuran Jersey:</strong> {{ $buyer->size_chart }}</li>
                @if ($buyer->komunitas)
                    <li><strong>Komunitas:</strong> {{ $buyer->komunitas }}</li>
                @endif
                <li><strong>NIK:</strong> {{ $buyer->nik }}</li>
                <li><strong>Tanggal Lahir:</strong> {{ $buyer->tanggal_lahir->format('d F Y') }}</li>
                <li><strong>Golongan Darah:</strong> {{ $buyer->golongan_darah ?? '-' }}</li>
                <li><strong>Total Pembayaran:</strong> Rp {{ number_format($buyer->total_amount, 0, ',', '.') }}</li>
                <li><strong>Tanggal Pembayaran:</strong> {{ $buyer->paid_at->format('d F Y H:i') }}</li>
                <li><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">AKTIF</span></li>
            </ul>

            @if ($buyer->qr_code_path)
                <div class="qr-code">
                    <p><strong>QR Code Tiket Anda:</strong></p>
                    <img src="{{ $buyer->qr_code_path }}" alt="QR Code Tiket"
                        style="max-width: 250px; border: 2px solid #ddd; padding: 10px; border-radius: 5px;">
                    <p style="font-size: 12px; color: #666;">Tunjukkan QR Code ini saat registrasi event</p>
                </div>
            @endif

            <p><strong>Informasi Kontak Darurat:</strong></p>
            <ul>
                <li><strong>Nama:</strong> {{ $buyer->nama_kontak_darurat }}</li>
                <li><strong>Nomor:</strong> {{ $buyer->nomor_kontak_darurat }}</li>
            </ul>

            <p><strong>Langkah Selanjutnya:</strong></p>
            <ul>
                <li>Simpan email ini untuk bukti pengambilan RPC dengan membawa kartu identitas (KTP)</li>
                <li>Datang Tepat Waktu pada saat pengambilan RPC</li>
            </ul>
            <p>Kami tunggu kehadiran Anda di event!</p>
        </div>
        <div class="footer">
            <p>Butuh bantuan? Hubungi kami di ticketifyid@gmail.com</p>
            <p>© {{ date('Y') }} TicketifyID. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>

</html>
