<!DOCTYPE html>
<html>

<head>
    <title>Pesanan Tiket Berhasil</title>
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
            <h1>Pesanan Tiket Berhasil</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $buyer->nama_lengkap }}</strong></p>
            <p>Terima kasih telah melakukan pemesanan. Pesanan Anda sedang menunggu konfirmasi pembayaran.</p>
            <ul>
                <li><strong>Order ID:</strong> {{ $buyer->external_id }}</li>
                <li><strong>Tiket:</strong> {{ $buyer->ticket->name }}</li>
                <li><strong>Jumlah:</strong> {{ $buyer->quantity }} tiket</li>
                <li><strong>Harga Tiket:</strong> Rp {{ number_format($buyer->ticket_price, 0, ',', '.') }}</li>
                <li><strong>Biaya Admin:</strong> Rp {{ number_format($buyer->admin_fee, 0, ',', '.') }}</li>
                @if ($buyer->discount_id && $buyer->discount)
                    <li><strong>Diskon ({{ $buyer->discount->name }}):</strong> - Rp
                        {{ number_format($buyer->discount->price, 0, ',', '.') }}</li>
                @endif
                <li><strong>Total Pembayaran:</strong> Rp {{ number_format($buyer->total_amount, 0, ',', '.') }}</li>
                <li><strong>Status:</strong> Menunggu Konfirmasi</li>
            </ul>
            <p>Bukti pembayaran Anda sedang diverifikasi. Anda akan menerima email konfirmasi dalam 1x24 jam.</p>
            <p><strong>Catatan:</strong> Simpan Order ID untuk referensi dan periksa email secara berkala.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} TicketifyID. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>

</html>
