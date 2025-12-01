<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KelolaPesanan; // Assuming you have a Booking model


class pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $fillable = [
        'pemesanan_id',
        'nama_pengirim',
        'metode_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'status'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(KelolaPemesanan::class, 'pemesanan_id');
    }
}
