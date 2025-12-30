<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->after('nama_lengkap');
            $table->string('nik', 16)->after('gender');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable()->after('nik');
            $table->text('alamat')->after('golongan_darah');
            $table->string('nama_bib', 100)->after('no_handphone');
            $table->string('komunitas', 100)->nullable()->after('nama_bib');
            $table->string('nama_kontak_darurat', 255)->after('komunitas');
            $table->string('nomor_kontak_darurat', 20)->after('nama_kontak_darurat');
        });
    }

    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'nik',
                'golongan_darah',
                'alamat',
                'nama_bib',
                'komunitas',
                'nama_kontak_darurat',
                'nomor_kontak_darurat'
            ]);
        });
    }
};
