<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->orderBy('tanggal_booking', 'asc')
            ->get();

        return view('reports.index', compact('bookings'));
    }
}