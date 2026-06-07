<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Statistik
        $totalBooking = Booking::where('user_id', $userId)->count();
        $totalLunas = Booking::where('user_id', $userId)
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_bayar');
        $totalBelumLunas = Booking::where('user_id', $userId)
            ->whereIn('status_pembayaran', ['DP', 'Belum Lunas'])
            ->count();

        // 5 Booking terbaru
        $recentBookings = Booking::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooking',
            'totalLunas',
            'totalBelumLunas',
            'recentBookings'
        ));
    }
}