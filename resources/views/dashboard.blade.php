@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Dashboard Admin</h3>
    <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
</div>

<!-- Kartu Statistik -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <h5 class="card-title">Total Booking</h5>
                <h2 class="fw-bold">{{ $totalBooking }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <h5 class="card-title">Total Pendapatan (Lunas)</h5>
                <h2 class="fw-bold">Rp {{ number_format($totalLunas, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title">Belum Lunas / DP</h5>
                <h2 class="fw-bold">{{ $totalBelumLunas }} Booking</h2>
            </div>
        </div>
    </div>
</div>

<!-- Tabel 5 Booking Terbaru -->
<div class="card shadow">
    <div class="card-header bg-white">
        <h5 class="mb-0">5 Booking Terbaru Anda</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Pemesan</th>
                        <th>Jenis Lapangan</th>
                        <th>Jam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</td>
                        <td>{{ $booking->nama_pemesan }}</td>
                        <td>{{ $booking->jenis_lapangan }}</td>
                        <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status_pembayaran == 'Lunas' ? 'success' : 'warning' }}">
                                {{ $booking->status_pembayaran }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data booking.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection