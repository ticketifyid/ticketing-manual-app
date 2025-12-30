<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_channel');
        });
    }

    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });
    }
};
