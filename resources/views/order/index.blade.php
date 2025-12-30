<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Ticket - Event Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #D4A574;
            --primary-dark: #B8935F;
            --success: #D4A574;
            --dark: #2C2C2C;
            --white: #ffffff;
            --gray-100: #F5F5F5;
            --gray-200: #E8E8E8;
            --gray-300: #D1D1D1;
            --gray-600: #666666;
            --gray-700: #4A4A4A;
            --gray-900: #2C2C2C;
            --danger: #dc3545;
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

        .navbar-brand i {
            color: var(--primary);
            margin-right: 0.5rem;
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

        .event-poster {
            width: 100%;
            height: 300px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--gray-200);
            border: 2px solid var(--gray-200);
        }

        .event-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .event-meta {
            display: flex;
            align-items: center;
            color: var(--gray-600);
            margin-bottom: 0.75rem;
            font-size: 14px;
        }

        .event-meta i {
            color: var(--primary);
            width: 18px;
            margin-right: 0.75rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            color: var(--primary);
            margin-right: 0.75rem;
        }

        .ticket-item {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .ticket-item:hover {
            border-color: var(--primary);
            box-shadow: 0 6px 20px rgba(212, 165, 116, 0.15);
            transform: translateY(-2px);
        }

        /* Styling untuk tiket sold out - lebih subtle */
        .ticket-item.sold-out {
            background: var(--gray-100);
            border-color: var(--gray-300);
        }

        .ticket-item.sold-out:hover {
            border-color: var(--gray-300);
            transform: none;
            box-shadow: none;
        }

        .ticket-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .ticket-description {
            color: var(--gray-600);
            font-size: 13px;
            margin-bottom: 0.5rem;
        }

        .ticket-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .ticket-item.sold-out .ticket-price {
            color: var(--gray-600);
        }

        .price-label {
            color: var(--gray-600);
            font-size: 12px;
            margin-bottom: 1rem;
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
            justify-content: center;
            box-shadow: 0 4px 12px rgba(212, 165, 116, 0.3);
            position: relative;
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

        /* Button sold out dengan badge */
        .btn-sold-out {
            background: var(--gray-300);
            color: var(--gray-600);
            cursor: not-allowed;
            box-shadow: none;
            position: relative;
            padding-right: 6rem;
        }

        .btn-sold-out:hover {
            background: var(--gray-300);
            transform: none;
            box-shadow: none;
        }

        .sold-out-badge {
            position: absolute;
            top: 50%;
            right: 0.75rem;
            transform: translateY(-50%);
            background: var(--danger);
            color: var(--white);
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer {
            flex-shrink: 0;
            background: var(--dark);
            color: var(--gray-600);
            padding: 2rem 0;
            margin-top: auto;
            border-top: 3px solid var(--primary);
        }

        .footer h4 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .event-title {
                font-size: 1.5rem;
            }

            .event-poster {
                height: 200px;
                margin-bottom: 1.5rem;
            }

            .ticket-item {
                padding: 1rem;
            }

            .btn-sold-out {
                padding-right: 5.5rem;
            }

            .sold-out-badge {
                font-size: 9px;
                padding: 0.2rem 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Minimal Navbar with Centered Logo -->
    <nav class="navbar">
        <div class="container">
            <a href="#">
                <img src="{{ asset('assets/media/logos/logo.png') }}" alt="Ticketify" class="navbar-brand"
                    height="50">
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container" style="margin-top: 100px; max-width: 1200px;">

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Event Details -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ $product->avatar ? Storage::url($product->avatar) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                alt="Event Poster" class="img-fluid" style="height: 400px; object-fit: contain;">
                        </div>
                        <div class="col-lg-8">
                            <h1 class="event-title">{{ $product->product_name }}</h1>

                            <div class="event-meta">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($product->event_date)->translatedFormat('d M Y') }}</span>
                            </div>

                            <div class="event-meta">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $product->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Categories -->
            <div class="card">
                <div class="card-body">
                    <h3 class="section-title">
                        Kategori Tiket
                    </h3>

                    <div class="row">
                        @foreach ($tickets as $ticket)
                            <div class="col-md-6">
                                <div class="ticket-item {{ $ticket->qty <= 0 ? 'sold-out' : '' }}">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex-grow-1">
                                            <h5 class="ticket-name">{{ $ticket->name }}</h5>
                                            <p class="ticket-description">Tiket reguler untuk akses umum</p>
                                        </div>
                                        <div class="text-end">
                                            <div class="ticket-price">Rp
                                                {{ number_format($ticket->price, 0, ',', '.') }}</div>
                                            <div class="price-label">per tiket</div>

                                            @if ($ticket->qty > 0)
                                                <a href="{{ route('order.create', ['ticket_id' => $ticket->id]) }}"
                                                    class="btn btn-primary">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    Pesan Sekarang
                                                </a>
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="fas fa-times-circle"></i>
                                                    SOLD OUT
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                    <h4>Ticketify</h4>
                    <p>Platform terpercaya untuk booking tiket event di Indonesia</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2025 Ticketify. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
