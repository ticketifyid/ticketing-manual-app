<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ url('/') }}/" />
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

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #A67C52 100%);
            transform: translateY(-2px);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(212, 165, 116, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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

        /* Checkbox Agreement Styling */
        .agreement-box {
            background: linear-gradient(135deg, #faf8f5 0%, #f5f3f0 100%);
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .agreement-box h6 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary);
        }

        .agreement-box h6 i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            color: var(--primary);
        }

        .agreement-text {
            max-height: 180px;
            overflow-y: auto;
            padding: 1.5rem;
            background-color: var(--white);
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 14px;
            line-height: 1.8;
            color: var(--gray-700);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .agreement-text::-webkit-scrollbar {
            width: 8px;
        }

        .agreement-text::-webkit-scrollbar-track {
            background: var(--gray-100);
            border-radius: 4px;
        }

        .agreement-text::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        .agreement-text::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        .agreement-text p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        .agreement-text p:last-child {
            margin-bottom: 0;
        }

        .form-check {
            padding: 1.25rem 1.25rem 1.25rem 1.5rem !important;
            background-color: var(--white);
            border: 2px solid var(--gray-300);
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            margin-left: 0 !important;
        }

        .form-check:hover {
            border-color: var(--primary);
            background-color: rgba(212, 165, 116, 0.05);
        }

        .form-check-input {
            width: 1.5rem;
            height: 1.5rem;
            min-width: 1.5rem;
            margin: 0 1rem 0 0 !important;
            cursor: pointer;
            border: 2px solid #999;
            border-radius: 5px;
            transition: all 0.3s ease;
            flex-shrink: 0;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            background-color: var(--white);
            float: none !important;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:checked::before {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.125rem;
            font-weight: bold;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(212, 165, 116, 0.25);
            border-color: var(--primary);
            outline: none;
        }

        .form-check-input:hover {
            border-color: var(--primary);
        }

        .form-check-label {
            font-size: 14px;
            color: var(--gray-700);
            cursor: pointer;
            line-height: 1.6;
            margin: 0;
            user-select: none;
        }

        /* Size Chart Preview Styling */
        .size-chart-preview {
            background-color: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .size-chart-preview:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(212, 165, 116, 0.2);
        }

        .size-chart-preview img {
            transition: transform 0.3s ease;
        }

        .size-chart-preview img:hover {
            transform: scale(1.02);
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
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_lahir"
                                            name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}"
                                            max="{{ date('Y-m-d', strtotime('-1 day')) }}" />
                                        @error('tanggal_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
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
                                        <label for="komunitas" class="form-label">Refferal</label>
                                        <input type="text" class="form-control" id="komunitas" name="komunitas"
                                            value="{{ old('komunitas') }}" placeholder="Nama Refferal (opsional)" />
                                        @error('komunitas')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Size Chart Section -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Size Chart <span
                                            class="text-danger">*</span></label>

                                    <!-- Preview Gambar Size Chart -->
                                    <div class="size-chart-preview mb-3">
                                        <img src="{{ asset('assets/media/size/sizechart.jpeg') }}" alt="Size Chart"
                                            class="img-fluid rounded border"
                                            style="max-width: 100%; height: auto; cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#sizeChartModal" />
                                        <small class="text-muted d-block mt-2">
                                            <i class="fas fa-info-circle me-1"></i>Klik gambar untuk melihat detail
                                            size chart
                                        </small>
                                    </div>

                                    <!-- Dropdown Size -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="size_chart" class="form-label">Pilih Ukuran <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="size_chart" name="size_chart" required>
                                                <option value="">Pilih Ukuran</option>
                                                <option value="XS"
                                                    {{ old('size_chart') == 'XS' ? 'selected' : '' }}>XS</option>
                                                <option value="S"
                                                    {{ old('size_chart') == 'S' ? 'selected' : '' }}>S</option>
                                                <option value="M"
                                                    {{ old('size_chart') == 'M' ? 'selected' : '' }}>M</option>
                                                <option value="L"
                                                    {{ old('size_chart') == 'L' ? 'selected' : '' }}>L</option>
                                                <option value="XL"
                                                    {{ old('size_chart') == 'XL' ? 'selected' : '' }}>XL</option>
                                                <option value="XXL"
                                                    {{ old('size_chart') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                                <option value="XXXL"
                                                    {{ old('size_chart') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                            </select>
                                            @error('size_chart')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
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

                                <!-- Agreement Box -->
                                <div class="agreement-box">
                                    <h6>
                                        <i class="fas fa-file-contract"></i>
                                        Syarat & Ketentuan
                                    </h6>
                                    <div class="agreement-text">
                                        <p>Menyatakan bahwa peserta mengikuti Event "Balapan Mlayu 2026" dalam keadaan
                                            sehat serta bersedia menjaga ketertiban, dan segala risiko yang timbul
                                            menjadi tanggung jawab pribadi.</p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="persetujuan"
                                            name="persetujuan" value="1"
                                            {{ old('persetujuan') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="persetujuan">
                                            Saya menyetujui syarat dan ketentuan yang berlaku <span
                                                class="text-danger">*</span>
                                        </label>
                                    </div>
                                    @error('persetujuan')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
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
                            <span>Biaya Admin:</span>
                            <span id="adminFee">
                                Rp 5.000
                            </span>
                        </div>

                        <div class="total-section">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total:</span>
                                <span class="total-price" id="totalPrice">
                                    Rp {{ number_format($ticket->price + 5000, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Size Chart -->
    <div class="modal fade" id="sizeChartModal" tabindex="-1" aria-labelledby="sizeChartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--dark); color: var(--white);">
                    <h5 class="modal-title" id="sizeChartModalLabel">
                        <i class="fas fa-ruler me-2"></i>Size Chart Detail
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <img src="{{ asset('assets/media/size/sizechart.jpeg') }}" alt="Size Chart Detail"
                        class="img-fluid w-100" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
            const ticketPriceEl = document.getElementById('ticketPrice');
            const adminFeeEl = document.getElementById('adminFee');
            const totalPriceEl = document.getElementById('totalPrice');
            const persetujuanCheckbox = document.getElementById('persetujuan');
            const submitBtn = document.getElementById('submitBtn');

            // Admin fee static
            const ADMIN_FEE = 5000;

            function updatePrices() {
                let price = parseInt(ticketPriceEl.getAttribute('data-price'), 10);
                let qty = 1; // Fixed ke 1 karena quantity hidden

                let ticketTotal = price * qty;
                let total = ticketTotal + ADMIN_FEE;

                ticketPriceEl.textContent = formatRupiah(ticketTotal);
                adminFeeEl.textContent = formatRupiah(ADMIN_FEE);
                totalPriceEl.textContent = formatRupiah(total);
            }

            // Enable/disable submit button based on checkbox
            persetujuanCheckbox.addEventListener('change', function() {
                submitBtn.disabled = !this.checked;
            });

            // Set initial state
            submitBtn.disabled = !persetujuanCheckbox.checked;

            updatePrices();
        });
    </script>
</body>

</html>
