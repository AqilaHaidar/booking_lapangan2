<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Tampilkan semua booking milik user login
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('bookings.index', compact('bookings'));
    }

    // Tampilkan form tambah booking
    public function create()
    {
        return view('bookings.create');
    }

    // Simpan booking baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'jenis_lapangan' => 'required|string|max:100',
            'tanggal_booking' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'total_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:Lunas,DP,Belum Lunas',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'nama_pemesan' => $request->nama_pemesan,
            'jenis_lapangan' => $request->jenis_lapangan,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'total_bayar' => $request->total_bayar,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect('/bookings')->with('success', 'Booking berhasil ditambahkan!');
    }

    // Tampilkan form edit booking
    public function edit($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('bookings.edit', compact('booking'));
    }

    // Update booking
    public function update(Request $request, $id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'jenis_lapangan' => 'required|string|max:100',
            'tanggal_booking' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'total_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:Lunas,DP,Belum Lunas',
        ]);

        $booking->update([
            'nama_pemesan' => $request->nama_pemesan,
            'jenis_lapangan' => $request->jenis_lapangan,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'total_bayar' => $request->total_bayar,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect('/bookings')->with('success', 'Booking berhasil diupdate!');
    }

    // Hapus booking
    public function destroy($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->delete();

        return redirect('/bookings')->with('success', 'Booking berhasil dihapus!');
    }
}