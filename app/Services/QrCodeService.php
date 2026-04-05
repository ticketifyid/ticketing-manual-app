<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate QR dari verify URL, simpan ke storage, return URL-nya
     */
    public function saveAndGetUrl(string $verifyUrl, string $externalId): string
    {
        $png  = QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->errorCorrection('M')
            ->generate($verifyUrl);

        $path = "qr_codes/qr_{$externalId}.png";

        if (!Storage::disk('public')->exists('qr_codes')) {
            Storage::disk('public')->makeDirectory('qr_codes');
        }

        Storage::disk('public')->put($path, $png);

        return url('storage/' . $path);
    }
}
