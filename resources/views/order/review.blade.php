<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Review Order - Event Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary: #D4A574;
            --primary-dark: #B8935F;
            --success: #28a745;
            --dark: #2C2C2C;
            --white: #ffffff;
            --gray-100: #F5F5F5;
            --gray-200: #E8E8E8;
            --gray-300: #D1D1D1;
            --gray-600: #666666;
            --gray-700: #4A4A4A;
            --gray-900: #2C2C2C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-700);
            font-size: 14px;
            line-height: 1.5;
        }

        .navbar {
            background: var(--dark);
            border-bottom: 1px solid var(--gray-600);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
            text-decoration: none;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar .container {
            display: flex;
            justify-content: center;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .card-title i {
            color: var(--primary);
            margin-right: 0.75rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 2rem;
            font-size: 14px;
        }

        .breadcrumb-item {
            color: var(--gray-600);
        }

        .breadcrumb-item.active {
            color: var(--gray-700);
            font-weight: 600;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }

        .info-box {
            background-color: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--gray-600);
            font-size: 14px;
        }

        .info-value {
            color: var(--dark);
            font-weight: 600;
            font-size: 14px;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 14px;
        }

        .form-select {
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: var(--white);
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(212, 165, 116, 0.15);
            background-color: var(--white);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: var(--white);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 12px rgba(212, 165, 116, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #A67C52 100%);
            transform: translateY(-2px);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(212, 165, 116, 0.4);
        }

        .btn-primary i {
            margin-right: 0.5rem;
        }

        .btn-secondary {
            background-color: var(--gray-200);
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: var(--gray-300);
            border-color: var(--gray-700);
            color: var(--gray-700);
        }

        .btn-secondary i {
            margin-right: 0.5rem;
        }

        .order-summary {
            background-color: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 2rem;
            position: sticky;
            top: 90px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .order-summary h5 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item span:first-child {
            color: var(--gray-600);
            font-size: 14px;
        }

        .summary-item span:last-child {
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .summary-item.discount span:last-child {
            color: var(--success);
        }

        .total-section {
            background-color: var(--gray-100);
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .discount-badge {
            background-color: var(--success);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-left: 0.5rem;
        }

        .alert {
            border: none;
            border-radius: 8px;
            font-size: 13px;
            padding: 1rem;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .footer {
            background: var(--dark);
            color: var(--gray-600);
            padding: 2rem 0;
            margin-top: 3rem;
            border-top: 3px solid var(--primary);
        }

        .footer h6 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        @media (max-width: 992px) {
            .order-summary {
                position: relative;
                top: auto;
                margin-top: 2rem;
            }

            .container-custom {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .order-summary {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('assets/media/logos/logo.png') }}" alt="Ticketify" height="50" />
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-custom" style="margin-top: 100px;">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('order.index') }}">
                        <i class="fas fa-home me-1"></i>Events
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('order.create', ['ticket_id' => $ticket->id]) }}">Order Form</a>
                </li>
                <li class="breadcrumb-item active">Review Order</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Order Details -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-check"></i> Review Pemesanan
                        </h3>

                        <!-- Data Pemesan -->
                        <h6 class="mb-3" style="font-weight: 600; color: var(--dark);">
                            <i class="fas fa-user me-2" style="color: var(--primary);"></i>
                            Data Pemesan
                        </h6>
                        <div class="info-box">
                            <div class="info-row">
                                <span class="info-label">Nama Lengkap</span>
                                <span class="info-value">{{ $formData['nama_lengkap'] }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Tanggal Lahir</span>
                                <span
                                    class="info-value">{{ \Carbon\Carbon::parse($formData['tanggal_lahir'])->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $formData['email'] }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">No. Handphone</span>
                                <span class="info-value">{{ $formData['no_handphone'] }}</span>
                            </div>
                        </div>

                        <!-- Detail Event -->
                        <h6 class="mb-3 mt-4" style="font-weight: 600; color: var(--dark);">
                            <i class="fas fa-ticket-alt me-2" style="color: var(--primary);"></i>
                            Detail Event & Tiket
                        </h6>
                        <div class="info-box">
                            <div class="info-row">
                                <span class="info-label">Event</span>
                                <span class="info-value">{{ $product->product_name }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Tanggal Event</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($product->event_date)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Lokasi</span>
                                <span class="info-value">{{ $product->location }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Kategori Tiket</span>
                                <span class="info-value">{{ $ticket->name }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Jumlah Tiket</span>
                                <span class="info-value">{{ $formData['quantity'] }} tiket</span>
                            </div>
                        </div>

                        <!-- Form Apply Discount -->
                        <h6 class="mb-3 mt-4" style="font-weight: 600; color: var(--dark);">
                            <i class="fas fa-tags me-2" style="color: var(--primary);"></i>
                            Kode Diskon (Opsional)
                        </h6>

                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="discount_code"
                                    placeholder="Masukkan kode diskon" style="text-transform: uppercase;">
                                <button class="btn btn-secondary" type="button" id="applyDiscountBtn"
                                    style="background: var(--primary); border: none; color: white;">
                                    <i class="fas fa-check me-1"></i>
                                    Apply
                                </button>
                            </div>
                            <small class="text-muted">Masukkan kode diskon jika Anda memilikinya</small>
                        </div>

                        <!-- Alert Success -->
                        <div class="alert alert-success" id="discountApplied" style="display: none;">
                            <i class="fas fa-check-circle me-2"></i>
                            <span id="discountMessage">Diskon berhasil diterapkan!</span>
                        </div>

                        <!-- Alert Error -->
                        <div class="alert alert-danger" id="discountError"
                            style="display: none; background-color: rgba(241, 65, 108, 0.1); border: 1px solid rgba(241, 65, 108, 0.2); color: #f1416c;">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span id="discountErrorMessage">Kode diskon tidak valid</span>
                        </div>

                        <!-- Form Submit -->
                        <!-- Form Submit -->
                        <form action="{{ route('order.payment') }}" method="POST" id="paymentForm" class="mt-4">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="hidden" name="discount_id" id="selected_discount_id" value="">

                            <!-- Data Pemesan (Hidden) -->
                            <input type="hidden" name="nama_lengkap" value="{{ $formData['nama_lengkap'] }}">
                            <input type="hidden" name="gender" value="{{ $formData['gender'] }}">
                            <input type="hidden" name="nik" value="{{ $formData['nik'] }}">
                            <input type="hidden" name="tanggal_lahir" value="{{ $formData['tanggal_lahir'] }}">
                            <input type="hidden" name="golongan_darah"
                                value="{{ $formData['golongan_darah'] ?? '' }}">
                            <input type="hidden" name="alamat" value="{{ $formData['alamat'] }}">
                            <input type="hidden" name="email" value="{{ $formData['email'] }}">
                            <input type="hidden" name="no_handphone" value="{{ $formData['no_handphone'] }}">
                            <input type="hidden" name="nama_bib" value="{{ $formData['nama_bib'] }}">
                            <input type="hidden" name="komunitas" value="{{ $formData['komunitas'] ?? '' }}">
                            <input type="hidden" name="nama_kontak_darurat"
                                value="{{ $formData['nama_kontak_darurat'] }}">
                            <input type="hidden" name="nomor_kontak_darurat"
                                value="{{ $formData['nomor_kontak_darurat'] }}">
                            <input type="hidden" name="quantity" value="{{ $formData['quantity'] }}">

                            <div class="d-flex gap-2">
                                <a href="{{ route('order.create', ['ticket_id' => $ticket->id]) }}"
                                    class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-credit-card"></i>
                                    Konfirmasi & Bayar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5><i class="fas fa-receipt me-2"></i> Ringkasan Biaya</h5>

                    <div class="summary-item">
                        <span>Harga Tiket ({{ $formData['quantity'] }}x)</span>
                        <span id="ticketPriceDisplay">Rp {{ number_format($ticket_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-item">
                        <span>Biaya Admin (5%)</span>
                        <span id="adminFeeDisplay">Rp {{ number_format($admin_fee, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-item discount" id="discountRow" style="display: none;">
                        <span>
                            Diskon
                            <span class="discount-badge">PROMO</span>
                        </span>
                        <span id="discountAmountDisplay">- Rp 0</span>
                    </div>

                    <div class="total-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Pembayaran:</span>
                            <span class="total-price" id="totalPriceDisplay">
                                Rp {{ number_format($total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- <div class="alert alert-info mt-3"
                        style="background-color: rgba(212, 165, 116, 0.1); border: 1px solid rgba(212, 165, 116, 0.2); color: var(--primary);">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Setelah konfirmasi, Anda akan diarahkan ke halaman pembayaran Xendit</small>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6>Ticketify</h6>
                    <p class="mb-0">Platform terpercaya untuk booking tiket event di Indonesia</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; 2025 Ticketify. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi format Rupiah
        function formatRupiah(number) {
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const discountCodeInput = document.getElementById('discount_code');
            const applyDiscountBtn = document.getElementById('applyDiscountBtn');
            const selectedDiscountInput = document.getElementById('selected_discount_id');
            const discountRow = document.getElementById('discountRow');
            const discountAmountDisplay = document.getElementById('discountAmountDisplay');
            const totalPriceDisplay = document.getElementById('totalPriceDisplay');
            const discountApplied = document.getElementById('discountApplied');
            const discountError = document.getElementById('discountError');
            const discountMessage = document.getElementById('discountMessage');
            const discountErrorMessage = document.getElementById('discountErrorMessage');

            // Data awal
            const ticketPrice = {{ $ticket_price }};
            const adminFee = {{ $admin_fee }};
            const ticketId = {{ $ticket->id }};
            let discountAmount = 0;
            let discountData = null;

            // Function update total
            function updateTotal() {
                const total = (ticketPrice + adminFee) - discountAmount;
                totalPriceDisplay.textContent = formatRupiah(total < 0 ? 0 : total);
            }

            // Auto uppercase input
            discountCodeInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });

            // Apply discount button
            applyDiscountBtn.addEventListener('click', function() {
                const discountCode = discountCodeInput.value.trim();

                if (!discountCode) {
                    discountError.style.display = 'block';
                    discountErrorMessage.textContent = 'Masukkan kode diskon terlebih dahulu';
                    discountApplied.style.display = 'none';
                    return;
                }

                // Disable button & show loading
                applyDiscountBtn.disabled = true;
                applyDiscountBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Validasi...';

                // AJAX request untuk validasi diskon
                fetch('{{ route('order.validate-discount') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            discount_code: discountCode,
                            ticket_id: ticketId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Diskon valid
                            discountAmount = parseFloat(data.discount_amount);
                            discountData = data;

                            // Update hidden input
                            selectedDiscountInput.value = data.discount_id;

                            // Tampilkan row diskon
                            discountRow.style.display = 'flex';
                            discountAmountDisplay.textContent = '- ' + formatRupiah(discountAmount);

                            // Show success message
                            discountApplied.style.display = 'block';
                            discountMessage.textContent = data.message;
                            discountError.style.display = 'none';

                            // Disable input setelah berhasil
                            discountCodeInput.disabled = true;
                            applyDiscountBtn.innerHTML = '<i class="fas fa-check me-1"></i>Applied';

                            // Update total
                            updateTotal();
                        } else {
                            // Diskon tidak valid
                            discountError.style.display = 'block';
                            discountErrorMessage.textContent = data.message;
                            discountApplied.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        discountError.style.display = 'block';
                        discountErrorMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                        discountApplied.style.display = 'none';
                    })
                    .finally(() => {
                        // Reset button
                        if (!discountData) {
                            applyDiscountBtn.disabled = false;
                            applyDiscountBtn.innerHTML = '<i class="fas fa-check me-1"></i>Apply';
                        }
                    });
            });

            // Enter key untuk apply
            discountCodeInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    applyDiscountBtn.click();
                }
            });

            // Initial total calculation
            updateTotal();

            // Form validation
            document.getElementById('paymentForm').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            });
        });
    </script>
</body>

</html>
