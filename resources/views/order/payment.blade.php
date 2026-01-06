<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Payment - Event Management</title>
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

        .bank-account-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            padding: 2rem;
            color: var(--white);
            margin-bottom: 2rem;
            box-shadow: 0 8px 20px rgba(212, 165, 116, 0.3);
        }

        .bank-account-box h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .bank-account-box h5 i {
            margin-right: 0.75rem;
            font-size: 1.5rem;
        }

        .bank-info {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .bank-info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .bank-info-row:last-child {
            margin-bottom: 0;
        }

        .bank-info-label {
            font-size: 13px;
            opacity: 0.9;
        }

        .bank-info-value {
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .copy-btn {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 12px;
            margin-left: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .copy-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .copy-btn i {
            margin-right: 0.25rem;
        }

        .upload-area {
            border: 2px dashed var(--gray-300);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            background-color: var(--gray-100);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background-color: rgba(212, 165, 116, 0.05);
        }

        .upload-area.dragover {
            border-color: var(--primary);
            background-color: rgba(212, 165, 116, 0.1);
        }

        .upload-area i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .upload-area p {
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }

        .file-input {
            display: none;
        }

        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            margin-top: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 14px;
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

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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

        .alert {
            border: none;
            border-radius: 8px;
            font-size: 13px;
            padding: 1rem;
        }

        .alert-info {
            background-color: rgba(212, 165, 116, 0.1);
            color: var(--primary);
            border: 1px solid rgba(212, 165, 116, 0.2);
        }

        .alert-warning {
            background-color: #fff8dd;
            color: #ffc700;
            border: 1px solid #ffeaa7;
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

        .text-danger {
            color: #f1416c !important;
            font-size: 12px;
            margin-top: 0.25rem;
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

            .bank-account-box {
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
                <li class="breadcrumb-item active">Payment</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Payment Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-credit-card"></i> Pembayaran
                        </h3>

                        <!-- Data Pembeli -->
                        <h6 class="mb-3" style="font-weight: 600; color: var(--dark);">
                            <i class="fas fa-user me-2" style="color: var(--primary);"></i>
                            Data Pembeli
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
                        </div>

                        <!-- Bank Account Info -->
                        <div class="bank-account-box">
                            <h5>
                                <i class="fas fa-university"></i>
                                Transfer ke Rekening Berikut
                            </h5>

                            <div class="bank-info">
                                <div class="bank-info-row">
                                    <div>
                                        <div class="bank-info-label">Nama Bank</div>
                                        <div class="bank-info-value">Bank BCA</div>
                                    </div>
                                </div>

                                <div class="bank-info-row">
                                    <div>
                                        <div class="bank-info-label">Nomor Rekening</div>
                                        <div class="bank-info-value">
                                            <span id="accountNumber">1234567890</span>
                                            <button type="button" class="copy-btn" onclick="copyAccountNumber()">
                                                <i class="fas fa-copy"></i>
                                                Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="bank-info-row">
                                    <div>
                                        <div class="bank-info-label">Atas Nama</div>
                                        <div class="bank-info-value">PT. Ticketify Indonesia</div>
                                    </div>
                                </div>

                                <div class="bank-info-row">
                                    <div>
                                        <div class="bank-info-label">Total Transfer</div>
                                        <div class="bank-info-value" style="font-size: 1.5rem;">
                                            Rp {{ number_format($total_amount, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-warning mt-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <small>Transfer sesuai dengan nominal yang tertera untuk mempercepat verifikasi</small>
                            </div>
                        </div>

                        <!-- Upload Bukti Pembayaran -->
                        <form action="{{ route('order.store') }}" method="POST" id="paymentForm"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Hidden Inputs - LENGKAP -->
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="hidden" name="discount_id" value="{{ $formData['discount_id'] ?? '' }}">

                            <!-- Data Pemesan Lengkap -->
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

                            <h6 class="mb-3" style="font-weight: 600; color: var(--dark);">
                                <i class="fas fa-upload me-2" style="color: var(--primary);"></i>
                                Upload Bukti Pembayaran <span class="text-danger">*</span>
                            </h6>

                            <div class="upload-area" id="uploadArea">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="mb-2"><strong>Klik atau drag & drop file di sini</strong></p>
                                <p class="mb-0">Format: JPG, PNG (Max: 2MB)</p>
                                <input type="file" class="file-input" id="payment_proof" name="payment_proof"
                                    accept="image/jpeg,image/png,image/jpg" required>
                            </div>

                            <div id="imagePreview" style="display: none; text-align: center;">
                                <img id="preview" class="preview-image" src="" alt="Preview">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="removeImage()">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            @error('payment_proof')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Pastikan bukti transfer terlihat jelas (tanggal, nominal, nama pengirim)</small>
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button type="button" class="btn btn-secondary" onclick="history.back()">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </button>
                                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5><i class="fas fa-receipt me-2"></i> Ringkasan Pesanan</h5>

                    <div class="summary-item">
                        <span>Event:</span>
                        <span>{{ $product->product_name }}</span>
                    </div>

                    <div class="summary-item">
                        <span>Kategori Tiket:</span>
                        <span>{{ $ticket->name }}</span>
                    </div>

                    <div class="summary-item">
                        <span>Jumlah:</span>
                        <span>{{ $formData['quantity'] }} tiket</span>
                    </div>

                    <hr style="border-color: var(--gray-300);">

                    <div class="summary-item">
                        <span>Harga Tiket:</span>
                        <span>Rp {{ number_format($ticket_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-item">
                        <span>Biaya Admin (5%):</span>
                        <span>Rp {{ number_format($admin_fee, 0, ',', '.') }}</span>
                    </div>

                    @if ($discount_amount > 0)
                        <div class="summary-item discount">
                            <span>Diskon ({{ $discount->name ?? 'Promo' }}):</span>
                            <span>- Rp {{ number_format($discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <div class="total-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Pembayaran:</span>
                            <span class="total-price">
                                Rp {{ number_format($total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="fas fa-clock me-2"></i>
                        <small>Pembayaran akan diverifikasi dalam 1x24 jam</small>
                    </div>
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
        // Copy account number
        function copyAccountNumber() {
            const accountNumber = document.getElementById('accountNumber').textContent;
            navigator.clipboard.writeText(accountNumber).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }

        // Upload area functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('payment_proof');
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');
        const submitBtn = document.getElementById('submitBtn');

        // Click to upload
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        // Handle file selection
        function handleFileSelect(file) {
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak valid. Gunakan JPG atau PNG.');
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                uploadArea.style.display = 'none';
                imagePreview.style.display = 'block';
                submitBtn.disabled = false;
            };
            reader.readAsDataURL(file);
        }

        // Remove image
        function removeImage() {
            fileInput.value = '';
            preview.src = '';
            uploadArea.style.display = 'block';
            imagePreview.style.display = 'none';
            submitBtn.disabled = true;
        }

        // Form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Mohon upload bukti pembayaran terlebih dahulu');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
        });
    </script>
</body>

</html>
