<?php

namespace App\Mail;

use App\Models\Buyer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $buyer;
    public $ticket;

    public function __construct(Buyer $buyer)
    {
        $this->buyer = $buyer;
        $this->ticket = $buyer->ticket;
    }

    public function build()
    {
        return $this->subject('Pembayaran Disetujui - Tiket Anda Aktif!')
            ->view('emails.order-approved');
    }
}
