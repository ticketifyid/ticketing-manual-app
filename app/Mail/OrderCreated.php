<?php

namespace App\Mail;

use App\Models\Buyer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $buyer;

    public function __construct(Buyer $buyer)
    {
        $this->buyer = $buyer->load('ticket', 'discount');
    }

    public function build()
    {
        return $this->subject('Pesanan Tiket Berhasil - Menunggu Konfirmasi')
            ->view('emails.order-created');
    }
}
