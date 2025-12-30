<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Buyer;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index()
    {
        $product = Product::latest()->first();
        $tickets = Ticket::where('status', 'published')->get();

        return view('order.index', compact('product', 'tickets'));
    }

    public function create($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        if ($ticket->status !== 'published') {
            return redirect()->route('order.index')
                ->with('error', 'Tiket tidak tersedia untuk dijual');
        }

        if ($ticket->qty <= 0) {
            return redirect()->route('order.index')
                ->with('error', 'Maaf, tiket sudah habis terjual');
        }

        $product = Product::first();

        return view('order.create', compact('product', 'ticket'));
    }

    public function review(Request $request)
    {
        // Debug log
        Log::info('Review method called', [
            'method' => $request->method(),
            'all_data' => $request->all()
        ]);

        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'nama_lengkap' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|string|size:16|regex:/^[0-9]{16}$/',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_handphone' => 'required|string|max:20',
            'nama_bib' => 'required|string|max:100',
            'komunitas' => 'nullable|string|max:100',
            'nama_kontak_darurat' => 'required|string|max:255',
            'nomor_kontak_darurat' => 'required|string|max:20',
            'quantity' => 'required|integer|in:1', // Hanya boleh 1
        ], [
            'nik.size' => 'NIK harus 16 digit',
            'nik.regex' => 'NIK harus berupa angka',
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'nama_bib.required' => 'Nama BIB wajib diisi',
            'nama_kontak_darurat.required' => 'Nama kontak darurat wajib diisi',
            'nomor_kontak_darurat.required' => 'Nomor kontak darurat wajib diisi',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $product = Product::first();

        // VALIDASI STOK
        if ($ticket->qty < $request->quantity) {
            return redirect()->back()
                ->with('error', 'Stok tiket tidak mencukupi. Stok tersedia: ' . $ticket->qty)
                ->withInput();
        }

        // Hitung biaya
        $ticket_price = $ticket->price * $request->quantity;
        $admin_fee = $ticket_price * 0.05;
        $total_amount = $ticket_price + $admin_fee;

        return view('order.review', compact('product', 'ticket', 'ticket_price', 'admin_fee', 'total_amount'))
            ->with('formData', $request->all());
    }

    public function validateDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $discount = Discount::where('name', $request->discount_code)
            ->where('ticket_id', $request->ticket_id)
            ->where('status', 'active')
            ->where('qty', '>', 0)
            ->first();

        if ($discount) {
            return response()->json([
                'success' => true,
                'discount_id' => $discount->id,
                'discount_name' => $discount->name,
                'discount_amount' => $discount->price,
                'message' => 'Kode diskon valid! Potongan Rp ' . number_format($discount->price, 0, ',', '.')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kode diskon tidak valid atau sudah habis'
            ], 404);
        }
    }

    public function payment(Request $request)
    {
        // Debug log
        Log::info('Payment method called', [
            'method' => $request->method(),
            'all_data' => $request->all()
        ]);

        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'discount_id' => 'nullable|exists:discounts,id',
            'nama_lengkap' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|string|size:16',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_handphone' => 'required|string|max:20',
            'nama_bib' => 'required|string|max:100',
            'komunitas' => 'nullable|string|max:100',
            'nama_kontak_darurat' => 'required|string|max:255',
            'nomor_kontak_darurat' => 'required|string|max:20',
            'quantity' => 'required|integer|in:1', // Hanya boleh 1
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $product = Product::first();

        // VALIDASI STOK
        if ($ticket->qty < $request->quantity) {
            return redirect()->route('order.create', ['ticket_id' => $ticket->id])
                ->with('error', 'Maaf, stok tiket sudah berkurang. Stok tersedia: ' . $ticket->qty);
        }

        // Hitung biaya
        $ticket_price = $ticket->price * $request->quantity;
        $discount_amount = 0;
        $discount = null;

        if ($request->filled('discount_id')) {
            $discount = Discount::find($request->discount_id);
            if ($discount && $discount->status === 'active' && $discount->qty > 0) {
                $discount_amount = $discount->price;
            }
        }

        $admin_fee = $ticket_price * 0.05;
        $total_amount = max(0, ($ticket_price + $admin_fee) - $discount_amount);

        return view('order.payment', compact('product', 'ticket', 'discount', 'ticket_price', 'admin_fee', 'discount_amount', 'total_amount'))
            ->with('formData', $request->all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'discount_id' => 'nullable|exists:discounts,id',
            'nama_lengkap' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|string|size:16|regex:/^[0-9]{16}$/',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_handphone' => 'required|string|max:20',
            'nama_bib' => 'required|string|max:100',
            'komunitas' => 'nullable|string|max:100',
            'nama_kontak_darurat' => 'required|string|max:255',
            'nomor_kontak_darurat' => 'required|string|max:20',
            'quantity' => 'required|integer|in:1', // Hanya boleh 1
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nik.size' => 'NIK harus 16 digit',
            'nik.regex' => 'NIK harus berupa angka',
            'payment_proof.required' => 'Bukti pembayaran wajib diupload',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // VALIDASI STOK FINAL
        if ($ticket->qty < $request->quantity) {
            return redirect()->back()
                ->with('error', 'Stok tiket tidak mencukupi. Stok tersedia: ' . $ticket->qty)
                ->withInput();
        }

        // Hitung biaya
        $ticket_price = $ticket->price * $request->quantity;
        $discount_amount = 0;
        $discount_id = null;

        // Validasi diskon
        if ($request->filled('discount_id')) {
            $discount = Discount::where('id', $request->discount_id)
                ->where('ticket_id', $ticket->id)
                ->where('status', 'active')
                ->where('qty', '>', 0)
                ->first();

            if ($discount) {
                $discount_amount = $discount->price;
                $discount_id = $discount->id;
            } else {
                return redirect()->back()
                    ->with('error', 'Maaf, diskon sudah tidak tersedia')
                    ->withInput();
            }
        }

        $admin_fee = $ticket_price * 0.05;
        $total_amount = max(0, ($ticket_price + $admin_fee) - $discount_amount);

        // Generate external ID unik
        do {
            $randomNumber = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
            $externalId = 'ORD-' . $randomNumber;
            $exists = Buyer::where('external_id', $externalId)->exists();
        } while ($exists);

        DB::beginTransaction();

        try {
            // VALIDASI STOK DALAM TRANSACTION
            $ticket = Ticket::lockForUpdate()->findOrFail($request->ticket_id);

            if ($ticket->qty < $request->quantity) {
                DB::rollback();
                return redirect()->back()
                    ->with('error', 'Maaf, tiket baru saja habis dibeli orang lain')
                    ->withInput();
            }

            // Upload bukti pembayaran
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = 'payment_' . $externalId . '.' . $file->getClientOriginalExtension();
                $paymentProofPath = $file->storeAs('payment_proofs', $filename, 'public');
            }

            // Kurangi stok
            $ticket->decrement('qty', $request->quantity);

            if ($discount_id) {
                Discount::where('id', $discount_id)->decrement('qty', 1);
            }

            // Simpan data buyer
            $buyer = Buyer::create([
                'nama_lengkap' => $request->nama_lengkap,
                'gender' => $request->gender,
                'nik' => $request->nik,
                'golongan_darah' => $request->golongan_darah,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_handphone' => $request->no_handphone,
                'nama_bib' => $request->nama_bib,
                'komunitas' => $request->komunitas,
                'nama_kontak_darurat' => $request->nama_kontak_darurat,
                'nomor_kontak_darurat' => $request->nomor_kontak_darurat,
                'quantity' => $request->quantity,
                'ticket_id' => $request->ticket_id,
                'discount_id' => $discount_id,
                'ticket_price' => $ticket_price,
                'admin_fee' => $admin_fee,
                'total_amount' => $total_amount,
                'external_id' => $externalId,
                'payment_proof' => $paymentProofPath,
                'payment_status' => 'pending',
                'payment_method' => 'manual_transfer',
            ]);

            // Generate QR Code
            try {
                $verifyUrl = route('ticket.verify', ['external_id' => $externalId]);
                $qrCodePath = 'qr_codes/qr_' . $externalId . '.png';

                if (!Storage::disk('public')->exists('qr_codes')) {
                    Storage::disk('public')->makeDirectory('qr_codes');
                }

                $qrCode = QrCode::format('png')
                    ->size(300)
                    ->margin(2)
                    ->generate($verifyUrl);

                Storage::disk('public')->put($qrCodePath, $qrCode);
                $qrCodeFullUrl = Storage::disk('public')->url($qrCodePath);

                $buyer->update(['qr_code_path' => $qrCodeFullUrl]);

                Log::info('Order Created Successfully', [
                    'buyer_id' => $buyer->id,
                    'external_id' => $externalId,
                    'payment_proof' => $paymentProofPath,
                    'qr_code_path' => $qrCodeFullUrl
                ]);
            } catch (Exception $qrException) {
                Log::error('QR Code Generation Failed', [
                    'buyer_id' => $buyer->id,
                    'external_id' => $externalId,
                    'error' => $qrException->getMessage()
                ]);
            }

            DB::commit();

            return redirect()->route('payment.success')
                ->with('success', 'Pembayaran berhasil diupload! Order ID: ' . $externalId)
                ->with('external_id', $externalId);
        } catch (Exception $e) {
            DB::rollback();

            Log::error('Order Creation Failed', [
                'error_message' => $e->getMessage(),
                'external_id' => $externalId ?? 'not_generated',
                'ticket_id' => $request->ticket_id,
                'stack_trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('order.create', ['ticket_id' => $request->ticket_id])
                ->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}
