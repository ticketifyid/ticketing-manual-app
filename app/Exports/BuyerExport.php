<?php

namespace App\Exports;

use App\Models\Buyer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Storage;

class BuyerExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $buyers;

    public function __construct()
    {
        $this->buyers = Buyer::with('ticket')->orderBy('created_at', 'asc')->get();
    }

    public function collection()
    {
        return $this->buyers;
    }

    public function headings(): array
    {
        return [
            'No',
            'ID Pesanan',
            'Nama',
            'Jenis Kelamin',  // +
            'NIK',            // +
            'Tanggal Lahir',  // +
            'Golongan Darah', // +
            'Alamat',         // +
            'Nama BIB',       // +
            'No HP',
            'Email',
            'Kategori Tiket',
            'Jumlah',
            'Size Chart',
            'Refferal',
            'Waktu Pemesanan',
            'Status Pembayaran',
            'Link Pembayaran',
            'Harga Tiket',
            'Biaya Layanan',
            'Total Harga',
        ];
    }

    public function map($buyer): array
    {
        static $no = 1;

        return [
            $no++,
            $buyer->external_id,
            $buyer->nama_lengkap,
            $buyer->gender,                                          // +
            $buyer->nik,                                             // +
            $buyer->tanggal_lahir?->translatedFormat('d F Y'),       // +
            $buyer->golongan_darah,                                  // +
            $buyer->alamat,                                          // +
            $buyer->nama_bib,                                        // +
            $buyer->no_handphone,
            $buyer->email,
            $buyer->ticket->name,
            $buyer->quantity,
            $buyer->size_chart,
            $buyer->komunitas,
            $buyer->created_at->translatedFormat('l, d F Y'),
            $buyer->payment_status,
            $buyer->xendit_invoice_url,
            $buyer->ticket_price,
            $buyer->admin_fee,
            $buyer->total_amount,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 20,  // ID Pesanan
            'C' => 25,  // Nama
            'D' => 15,  // Jenis Kelamin
            'E' => 20,  // NIK
            'F' => 18,  // Tanggal Lahir
            'G' => 15,  // Golongan Darah
            'H' => 30,  // Alamat
            'I' => 20,  // Nama BIB
            'J' => 15,  // No HP
            'K' => 25,  // Email
            'L' => 20,  // Kategori Tiket
            'M' => 8,   // Jumlah
            'N' => 15,  // Size Chart
            'O' => 20,  // Komunitas
            'P' => 20,  // Waktu Pemesanan
            'Q' => 15,  // Status Pembayaran
            'R' => 30,  // Link Pembayaran
            'S' => 12,  // Harga Tiket
            'T' => 12,  // Biaya Layanan
            'U' => 12,  // Total Harga
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getRowDimension('1')->setRowHeight(30);

        $totalRows = $this->buyers->count() + 1;
        for ($row = 2; $row <= $totalRows; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(25);
        }

        // Ganti semua 'O' jadi 'U'
        $sheet->getStyle('A1:U1')->getFont()->setBold(true);
        $sheet->getStyle('A1:U1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('CCCCCC');

        $sheet->getStyle('A1:U' . $totalRows)->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        return [];
    }
}
