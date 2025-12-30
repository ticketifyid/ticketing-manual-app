@extends('admin.layouts.app')
@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack flex-wrap">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Detail Pesanan
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.buyer.index') }}" class="text-muted text-hover-primary">Data Pembeli</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Detail Pesanan</li>
                    </ul>
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.buyer.index') }}" class="btn btn-light btn-sm">
                        <i class="ki-duotone ki-arrow-left fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Kembali
                    </a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                    <i class="ki-duotone ki-check-circle fs-2hx text-success me-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-success">Berhasil!</h4>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="row g-5 g-xl-10">
                <!--begin::Order Details-->
                <div class="col-xl-8">
                    <!--begin::Customer Info-->
                    <div class="card card-flush mb-5">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Informasi Pemesan</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">ID Pesanan</td>
                                            <td class="text-gray-800 fw-bold">{{ $buyer->external_id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Nama Lengkap</td>
                                            <td class="text-gray-800 fw-bold">{{ $buyer->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email</td>
                                            <td class="text-gray-800">{{ $buyer->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">No. Handphone</td>
                                            <td class="text-gray-800">{{ $buyer->no_handphone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Customer Info-->

                    <!--begin::Ticket Details-->
                    <div class="card card-flush mb-5">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Detail Tiket</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted min-w-125px w-125px">Kategori Tiket</td>
                                            <td>
                                                <span
                                                    class="badge badge-light fw-bold fs-6">{{ $buyer->ticket->name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Quantity</td>
                                            <td class="text-gray-800 fw-bold">{{ $buyer->quantity }} tiket</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Harga Tiket</td>
                                            <td class="text-gray-800">Rp
                                                {{ number_format($buyer->ticket_price, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Admin Fee</td>
                                            <td class="text-gray-800">Rp
                                                {{ number_format($buyer->admin_fee, 0, ',', '.') }}</td>
                                        </tr>
                                        @if ($buyer->discount)
                                            <tr>
                                                <td class="text-muted">Diskon</td>
                                                <td class="text-gray-800">{{ $buyer->discount->code }}
                                                    ({{ $buyer->discount->discount_percentage }}%)</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-muted fw-bold fs-5">Total Amount</td>
                                            <td class="text-gray-900 fw-bolder fs-3">Rp
                                                {{ number_format($buyer->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Tanggal Pemesanan</td>
                                            <td class="text-gray-800">{{ $buyer->created_at->format('d F Y, H:i') }} WIB
                                            </td>
                                        </tr>
                                        @if ($buyer->paid_at)
                                            <tr>
                                                <td class="text-muted">Tanggal Pembayaran</td>
                                                <td class="text-gray-800">{{ $buyer->paid_at->format('d F Y, H:i') }} WIB
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Ticket Details-->
                </div>
                <!--end::Order Details-->

                <!--begin::Status & Actions-->
                <div class="col-xl-4">
                    <!--begin::Payment Proof Card-->
                    @if ($buyer->payment_proof)
                        <div class="card card-flush mb-5">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Bukti Pembayaran</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="text-center">
                                    <a href="{{ asset('storage/' . $buyer->payment_proof) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $buyer->payment_proof) }}" alt="Bukti Pembayaran"
                                            class="w-100 rounded border border-gray-300" style="cursor: pointer;">
                                    </a>
                                    <div class="mt-3">
                                        <a href="{{ asset('storage/' . $buyer->payment_proof) }}" target="_blank"
                                            class="btn btn-light-primary btn-sm w-100">
                                            <i class="ki-duotone ki-eye fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            Lihat Bukti Pembayaran
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card card-flush mb-5 d-none d-xl-block">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Bukti Pembayaran</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="alert alert-warning d-flex align-items-center p-5">
                                    <i class="ki-duotone ki-information-5 fs-2hx text-warning me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Bukti pembayaran belum diunggah</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--end::Payment Proof Card (Desktop)-->

                    <!--begin::Status Card-->
                    <div class="card card-flush mb-5">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Status Pembayaran</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            @php
                                $statusColors = [
                                    'paid' => 'success',
                                    'pending' => 'warning',
                                    'failed' => 'danger',
                                ];
                                $statusIcons = [
                                    'paid' => 'check-circle',
                                    'pending' => 'time',
                                    'failed' => 'cross-circle',
                                ];
                                $color = $statusColors[$buyer->payment_status] ?? 'secondary';
                                $icon = $statusIcons[$buyer->payment_status] ?? 'information';
                            @endphp

                            <div class="d-flex flex-center flex-column py-5">
                                <i class="ki-duotone ki-{{ $icon }} fs-5x text-{{ $color }} mb-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <div class="badge badge-light-{{ $color }} fs-1 fw-bold mb-3">
                                    {{ ucfirst($buyer->payment_status) }}
                                </div>

                                @if ($buyer->payment_method)
                                    <div class="text-gray-600 fw-semibold fs-6">
                                        Metode Pembayaran: {{ $buyer->payment_method }}
                                    </div>
                                @endif

                                @if ($buyer->payment_updated_at)
                                    <div class="text-gray-500 fw-semibold fs-7 mt-2">
                                        Update terakhir: {{ $buyer->payment_updated_at->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                            </div>

                            <div class="separator separator-dashed mb-7"></div>

                            <!--begin::Actions-->
                            <div class="d-flex flex-column gap-3">
                                @if ($buyer->payment_status === 'pending')
                                    <form action="{{ route('admin.buyer.approve', $buyer->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pesanan ini?')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="ki-duotone ki-check-circle fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Approve Pesanan
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.buyer.reject', $buyer->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menolak pesanan ini?')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="ki-duotone ki-cross-circle fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Reject Pesanan
                                        </button>
                                    </form>
                                @endif

                                @if ($buyer->payment_status === 'paid')
                                    <div class="alert alert-success d-flex align-items-center p-5">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">Pesanan sudah dibayar</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($buyer->payment_status === 'failed')
                                    <div class="alert alert-danger d-flex align-items-center p-5">
                                        <i class="ki-duotone ki-information fs-2hx text-danger me-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">Pesanan ditolak/gagal</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--end::Actions-->
                        </div>
                    </div>
                    <!--end::Status Card-->

                    <!--begin::QR Code Card-->
                    @if ($buyer->qr_code_path)
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>QR Code</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 text-center">
                                <img src="{{ asset('storage/' . $buyer->qr_code_path) }}" alt="QR Code"
                                    class="w-100 mw-250px">
                            </div>
                        </div>
                    @endif
                    <!--end::QR Code Card-->
                </div>
                <!--end::Status & Actions-->
            </div>

        </div>
    </div>
    <!--end::Content-->
@endsection
