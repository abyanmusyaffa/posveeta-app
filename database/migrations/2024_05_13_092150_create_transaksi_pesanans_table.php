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
        Schema::create('transaksi_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id');
            $table->string('jenis_pembayaran');
            $table->string('status_pembayaran');
            $table->string('ket_transaksi_pesanan')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pesanans');
    }
};