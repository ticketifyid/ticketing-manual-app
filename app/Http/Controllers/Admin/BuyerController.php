<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Buyer;
use App\Mail\OrderApproved;
use App\Mail\OrderRejected;
use App\Exports\BuyerExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::with(['ticket'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        // Statistik Pendapatan
        $totalRevenue = Buyer::where('payment_status', 'paid')
            ->sum('ticket_price');

        $totalTicketsSold = Buyer::where('payment_status', 'paid')
            ->sum('quantity');

        // Statistik per kategori tiket
        $ticketStats = Buyer::with(['ticket'])
            ->where('payment_status', 'paid')
            ->selectRaw('ticket_id, COUNT(*) as total_orders, SUM(quantity) as total_quantity, SUM(ticket_price) as total_revenue')
            ->groupBy('ticket_id')
            ->get()
            ->map(function ($item) {
                return [
                    'ticket_name' => $item->ticket->name,
                    'total_orders' => $item->total_orders,
                    'total_quantity' => $item->total_quantity,
                    'total_revenue' => $item->total_revenue,
                ];
            });

        return view('admin.page.buyer.index', compact('buyers', 'totalRevenue', 'totalTicketsSold', 'ticketStats'));
    }

    public function show($id)
    {
        $buyer = Buyer::with(['ticket', 'discount'])->findOrFail($id);

        return view('admin.page.buyer.detail', compact('buyer'));
    }

    public function approve($id)
    {
        try {
            $buyer = Buyer::with(['ticket', 'discount'])->findOrFail($id);

            // Update status pembayaran
            $buyer->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
                'payment_updated_at' => now()
            ]);

            Log::info('Order approved', [
                'buyer_id' => $buyer->id,
                'external_id' => $buyer->external_id,
                'email' => $buyer->email
            ]);

            // Kirim email notifikasi approval
            try {
                Mail::to($buyer->email)->send(new OrderApproved($buyer));

                Log::info('Order approval email sent successfully', [
                    'buyer_id' => $buyer->id,
                    'external_id' => $buyer->external_id,
                    'email' => $buyer->email
                ]);

                return redirect()->route('admin.buyer.show', $id)
                    ->with('success', 'Pesanan berhasil disetujui dan email notifikasi telah dikirim ke ' . $buyer->email);
            } catch (Exception $mailException) {
                Log::error('Failed to send approval email', [
                    'buyer_id' => $buyer->id,
                    'external_id' => $buyer->external_id,
                    'email' => $buyer->email,
                    'error' => $mailException->getMessage(),
                    'trace' => $mailException->getTraceAsString()
                ]);

                return redirect()->route('admin.buyer.show', $id)
                    ->with('warning', 'Pesanan berhasil disetujui, namun gagal mengirim email notifikasi. Error: ' . $mailException->getMessage());
            }
        } catch (Exception $e) {
            Log::error('Failed to approve order', [
                'buyer_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.buyer.show', $id)
                ->with('error', 'Gagal menyetujui pesanan: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $buyer = Buyer::with(['ticket', 'discount'])->findOrFail($id);

            // Update status pembayaran
            $buyer->update([
                'payment_status' => 'failed',
                'payment_updated_at' => now()
            ]);

            Log::info('Order rejected', [
                'buyer_id' => $buyer->id,
                'external_id' => $buyer->external_id,
                'email' => $buyer->email
            ]);

            // Kirim email notifikasi rejection
            try {
                Mail::to($buyer->email)->send(new OrderRejected($buyer));

                Log::info('Order rejection email sent successfully', [
                    'buyer_id' => $buyer->id,
                    'external_id' => $buyer->external_id,
                    'email' => $buyer->email
                ]);

                return redirect()->route('admin.buyer.show', $id)
                    ->with('success', 'Pesanan ditolak dan email notifikasi telah dikirim ke ' . $buyer->email);
            } catch (Exception $mailException) {
                Log::error('Failed to send rejection email', [
                    'buyer_id' => $buyer->id,
                    'external_id' => $buyer->external_id,
                    'email' => $buyer->email,
                    'error' => $mailException->getMessage(),
                    'trace' => $mailException->getTraceAsString()
                ]);

                return redirect()->route('admin.buyer.show', $id)
                    ->with('warning', 'Pesanan ditolak, namun gagal mengirim email notifikasi. Error: ' . $mailException->getMessage());
            }
        } catch (Exception $e) {
            Log::error('Failed to reject order', [
                'buyer_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.buyer.show', $id)
                ->with('error', 'Gagal menolak pesanan: ' . $e->getMessage());
        }
    }

    public function export()
    {
        $timestamp = now()->format('Y-m-d');
        return Excel::download(new BuyerExport, "data-pesanan_{$timestamp}.xlsx");
    }
}
