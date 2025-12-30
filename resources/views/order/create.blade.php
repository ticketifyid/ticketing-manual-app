<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Form - Event Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary: #D4A574;
            --primary-dark: #B8935F;
            --dark: #2C2C2C;
            --white: #ffffff;
            --gray-100: #F5F5F5;
            --gray-200: #E8E8E8;
            --gray-300: #D1D1D1;
            --gray-600: #666666;
            --gray-700: #4A4A4A;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-700);
            font-size: 14px;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .main-content {
            flex: 1 0 auto;
            padding-bottom: 2rem;
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

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: var(--white);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(212, 165, 116, 0.15);
            background-color: var(--white);
        }

        .form-control.is-invalid {
            border-color: #f1416c;
        }

        .text-danger {
            color: #f1416c !important;
            font-size: 12px;
            margin-top: 0.25rem;
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

        .event-info {
            background-color: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .event-info img {
            border-radius: 8px;
        }

        .event-info h5 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 0.75rem;
            font-size: 1.125rem;
        }

        .event-info .text-muted {
            color: var(--gray-600) !important;
            font-size: 14px;
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

        .footer {
            flex-shrink: 0;
            background: var(--dark);
            color: var(--gray-600);
            padding: 2rem 0;
            margin-top: auto;
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
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('assets/media/logos/logo.png') }}" alt="Ticketify" height="50" />
            </a>
        </div>
    </nav>

    <div class="main-content">
        <div class="container-custom" style="margin-top: 100px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('order.index') }}">
                            <i class="fas fa-home me-1"></i>Events
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Order Form</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">
                                <i class="fas fa-shopping-cart"></i> Form Pemesanan Tiket
                            </h3>

                            <div class="event-info mb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <img src="{{ $product->avatar ? Storage::url($product->avatar) : 'https://via.placeholder.com/150x100?text=No+Image' }}"
                                            alt="Event" class="img-fluid rounded" />
                                    </div>
                                    <div class="col-md-9">
                                        <h5>{{ $product->product_name }}</h5>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-calendar me-2"></i>
                                            {{ \Carbon\Carbon::parse($product->event_date)->translatedFormat('d M Y') }}
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-map-marker-alt me-2"></i> {{ $product->location }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('order.review') }}" method="POST" id="orderForm">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            required value="{{ old('nama_lengkap') }}"
                                            placeholder="Masukkan nama lengkap" />
                                        @error('nama_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki"
                                                {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan"
                                                {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            required value="{{ old('nik') }}" placeholder="16 digit NIK"
                                            maxlength="16" pattern="\d{16}" />
                                        @error('nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                        <select class="form-select" id="golongan_darah" name="golongan_darah">
                                            <option value="">Pilih Golongan Darah</option>
                                            <option value="A"
                                                {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B"
                                                {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="AB"
                                                {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                            <option value="O"
                                                {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                                        </select>
                                        @error('golongan_darah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Lengkap <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" required rows="3"
                                        placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required value="{{ old('email') }}" placeholder="contoh@mail.com" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_handphone" class="form-label">No. Handphone <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="no_handphone"
                                            name="no_handphone" required value="{{ old('no_handphone') }}"
                                            placeholder="08123456789" />
                                        @error('no_handphone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_bib" class="form-label">Nama BIB <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_bib" name="nama_bib"
                                            required value="{{ old('nama_bib') }}"
                                            placeholder="Nama yang tertera di BIB" />
                                        @error('nama_bib')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="komunitas" class="form-label">Komunitas</label>
                                        <input type="text" class="form-control" id="komunitas" name="komunitas"
                                            value="{{ old('komunitas') }}" placeholder="Nama komunitas (opsional)" />
                                        @error('komunitas')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_kontak_darurat" class="form-label">Nama Kontak Darurat <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_kontak_darurat"
                                            name="nama_kontak_darurat" required
                                            value="{{ old('nama_kontak_darurat') }}"
                                            placeholder="Nama kontak darurat" />
                                        @error('nama_kontak_darurat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nomor_kontak_darurat" class="form-label">Nomor Kontak Darurat
                                            <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="nomor_kontak_darurat"
                                            name="nomor_kontak_darurat" required
                                            value="{{ old('nomor_kontak_darurat') }}" placeholder="08123456789" />
                                        @error('nomor_kontak_darurat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hidden input untuk quantity dengan nilai default 1 -->
                                <input type="hidden" id="quantity" name="quantity" value="1" />

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-credit-card"></i> Lanjut ke Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-summary">
                        <h5><i class="fas fa-receipt me-2"></i> Ringkasan Pesanan</h5>

                        <div class="summary-item">
                            <span>Kategori Tiket:</span>
                            <span>{{ $ticket->name }}</span>
                        </div>

                        <div class="summary-item">
                            <span>Harga Tiket:</span>
                            <span id="ticketPrice" data-price="{{ $ticket->price }}">
                                Rp {{ number_format($ticket->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="summary-item">
                            <span>Biaya Admin (5%):</span>
                            <span id="adminFee">
                                Rp {{ number_format($ticket->price * 0.05, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="total-section">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total:</span>
                                <span class="total-price" id="totalPrice">
                                    Rp {{ number_format($ticket->price * 1.05, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        function formatRupiah(number) {
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const qtyInput = document.getElementById('quantity');
            const ticketPriceEl = document.getElementById('ticketPrice');
            const adminFeeEl = document.getElementById('adminFee');
            const totalPriceEl = document.getElementById('totalPrice');

            function updatePrices() {
                let price = parseInt(ticketPriceEl.getAttribute('data-price'), 10);
                let qty = 1; // Fixed ke 1 karena quantity hidden

                let ticketTotal = price * qty;
                let adminFee = Math.round(ticketTotal * 0.05);
                let total = ticketTotal + adminFee;

                ticketPriceEl.textContent = formatRupiah(ticketTotal);
                adminFeeEl.textContent = formatRupiah(adminFee);
                totalPriceEl.textContent = formatRupiah(total);
            }

            updatePrices();
        });
    </script>
</body>

</html>
