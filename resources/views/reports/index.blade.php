@extends('layouts.app')

@section('title', 'Laporan Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 no-print">
    <h3>Laporan Booking</h3>
    <button onclick="window.print()" class="btn btn-success">️ Cetak Laporan</button>
</div>

<div id="area-cetak">
    <div class="text-center mb-4">
        <h4>LAPORAN BOOKING LAPANGAN OLAHRAGA</h4>
        <p class="mb-1">Admin: <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})</p>
        <p>Tanggal Cetak: {{ date('d-m-Y H:i:s') }}</p>
        <hr>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th>Nama Pemesan</th>
                <th>Jenis Lapangan</th>
                <th>Tanggal Booking</th>
                <th>Jam</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $index => $booking)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $booking->nama_pemesan }}</td>
                <td>{{ $booking->jenis_lapangan }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</td>
                <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                <td>Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}</td>
                <td>{{ $booking->status_pembayaran }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data booking untuk dicetak.</td>
            </tr>
            @endforelse
        </tbody>
        @if($bookings->count() > 0)
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Total Keseluruhan:</th>
                <th colspan="2">Rp {{ number_format($bookings->sum('total_bayar'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

<!-- CSS Khusus Cetak -->
<style>
    @media print {
        .no-print { display: none !important; }
        .navbar { display: none !important; }
        body { background-color: white !important; }
        .container { max-width: 100% !important; }
        .card { box-shadow: none !important; border: none !important; }
    }
</style>
@endsection