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
            'Jenis Kelamin',
            'NIK',
            'Tanggal Lahir',
            'Golongan Darah',
            'Alamat',
            'Nama BIB',
            'No HP',
            'Email',
            'Kategori Tiket',
            'Jumlah',
            'Size Chart',
            'Refferal',
            'Nama Kontak Darurat',
            'No Kontak Darurat',
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
            $buyer->gender,
            $buyer->nik,
            $buyer->tanggal_lahir?->translatedFormat('d F Y'),
            $buyer->golongan_darah,
            $buyer->alamat,
            $buyer->nama_bib,
            $buyer->no_handphone,
            $buyer->email,
            $buyer->ticket->name,
            $buyer->quantity,
            $buyer->size_chart,
            $buyer->komunitas,
            $buyer->nama_kontak_darurat,
            $buyer->nomor_kontak_darurat,
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
            'P' => 25,  // Nama Kontak Darurat
            'Q' => 18,  // No Kontak Darurat
            'R' => 20,  // Waktu Pemesanan
            'S' => 15,  // Status Pembayaran
            'T' => 30,  // Link Pembayaran
            'U' => 12,  // Harga Tiket
            'V' => 12,  // Biaya Layanan
            'W' => 12,  // Total Harga
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getRowDimension('1')->setRowHeight(30);

        $totalRows = $this->buyers->count() + 1;
        for ($row = 2; $row <= $totalRows; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(25);
        }

        $sheet->getStyle('A1:W1')->getFont()->setBold(true);
        $sheet->getStyle('A1:W1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('CCCCCC');

        $sheet->getStyle('A1:W' . $totalRows)->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        return [];
    }
}
