<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kelola_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan')->unique();
            $table->unsignedBigInteger('penghuni_id'); // Relasi ke tabel 'users' untuk penghuni
            $table->unsignedBigInteger('kamar_id'); // Relasi ke tabel 'kelola_kamar' untuk kamar
            $table->date('tanggal_sewa'); // Tanggal sewa


            $table->timestamps();

            // Menambahkan foreign key constraint untuk penghuni dan kamar
            $table->foreign('penghuni_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kamar_id')->references('id')->on('kelola_kamar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_pemesanan');
    }




};
