<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            // Drop kolom yang berkaitan dengan Xendit
            $table->dropColumn([
                'xendit_invoice_id',
                'xendit_invoice_url',
                'payment_channel'
            ]);

            // Drop kolom yang sudah tidak dipakai
            $table->dropColumn([
                'nama_instagram',
                'alamat_lengkap',
                'kode_pos',
                'ukuran_jersey',
                'qr_code' // karena sudah pakai qr_code_path
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            // Restore kolom Xendit
            $table->string('xendit_invoice_id')->nullable()->after('external_id');
            $table->string('xendit_invoice_url')->nullable()->after('xendit_invoice_id');
            $table->string('payment_channel')->nullable()->after('payment_method');

            // Restore kolom yang tidak dipakai
            $table->string('nama_instagram')->nullable()->after('no_handphone');
            $table->text('alamat_lengkap')->nullable()->after('nama_instagram');
            $table->string('kode_pos')->nullable()->after('alamat_lengkap');
            $table->string('ukuran_jersey')->nullable()->after('kode_pos');
            $table->text('qr_code')->nullable()->after('total_amount');
        });
    }
};
