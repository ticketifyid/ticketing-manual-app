<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran Ditolak</title>
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
            background: #dc3545;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
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
            <h1>Pembayaran Ditolak</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $buyer->nama_lengkap }}</strong></p>
            <p>Mohon maaf, pembayaran untuk pesanan Anda dengan Order ID <strong>{{ $buyer->external_id }}</strong>
                tidak dapat kami konfirmasi.</p>

            <ul>
                <li><strong>Order ID:</strong> {{ $buyer->external_id }}</li>
                <li><strong>Tiket:</strong> {{ $buyer->ticket->name }}</li>
                <li><strong>Email:</strong> {{ $buyer->email }}</li>
                <li><strong>No. HP:</strong> {{ $buyer->no_handphone }}</li>
                <li><strong>Total Pembayaran:</strong> Rp {{ number_format($buyer->total_amount, 0, ',', '.') }}</li>
                <li><strong>Status:</strong> <span style="color: #dc3545; font-weight: bold;">Ditolak</span></li>
            </ul>

            <p><strong>Kemungkinan Penyebab:</strong></p>
            <ul>
                <li>Bukti pembayaran tidak jelas/blur</li>
                <li>Nominal transfer tidak sesuai (Total: Rp {{ number_format($buyer->total_amount, 0, ',', '.') }})
                </li>
                <li>Transfer ke rekening yang salah</li>
                <li>Bukti pembayaran tidak valid</li>
            </ul>

            <p><strong>Apa yang harus dilakukan?</strong></p>
            <ol>
                <li>Periksa kembali bukti pembayaran Anda</li>
                <li>Pastikan transfer sudah berhasil dengan nominal yang benar</li>
                <li>Hubungi kami untuk klarifikasi di <strong>ticketifyid@gmail.com</strong> atau
                    <strong>WhatsApp</strong></li>
                <li>Atau lakukan pemesanan baru dengan bukti pembayaran yang benar</li>
            </ol>

            <p>Jika ada pertanyaan lebih lanjut, silakan hubungi layanan pelanggan kami dengan menyertakan Order ID
                Anda.</p>
        </div>
        <div class="footer">
            <p>Butuh bantuan? Hubungi kami di ticketifyid@gmail.com</p>
            <p>© {{ date('Y') }} TicketifyID. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>

</html>
