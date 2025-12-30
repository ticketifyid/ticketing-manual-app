<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'gender',
        'nik',
        'golongan_darah',
        'alamat',
        'email',
        'no_handphone',
        'nama_bib',
        'komunitas',
        'nama_kontak_darurat',
        'nomor_kontak_darurat',
        'quantity',
        'ticket_id',
        'discount_id',
        'ticket_price',
        'admin_fee',
        'total_amount',
        'external_id',
        'qr_code_path',
        'payment_status',
        'paid_at',
        'payment_updated_at',
        'payment_method',
        'payment_proof'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'payment_updated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
