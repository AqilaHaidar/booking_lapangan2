<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'nama_pemesan', 'jenis_lapangan', 'tanggal_booking', 
        'jam_mulai', 'jam_selesai', 'total_bayar', 'status_pembayaran'
    ];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }
}