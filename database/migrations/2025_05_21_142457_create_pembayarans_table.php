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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembayaran')->unique(); // Kode unik untuk pembayaran
            $table->unsignedBigInteger('pemesanan_id'); // Relasi ke tabel 'kelola_pemesanan' untuk pemesanan
            $table->string('nama_pengirim'); // Nama penghuni
            $table->enum('metode_pembayaran', ['Transfer Bank', 'Kartu Kredit', 'Dompet Digital']); // Metode pembayaran
            $table->string('bukti_pembayaran')->nullable(); // Bukti pembayaran (opsional)
            $table->date('tanggal_pembayaran'); // Tanggal pembayaran
            $table->decimal('jumlah_pembayaran', 10, 2); // Jumlah pembayaran
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak']); // Status pemesanan
            $table->timestamps();

            // Menambahkan foreign key constraint untuk pemesanan
            $table->foreign('pemesanan_id')->references('id')->on('kelola_pemesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');

    }


};
