@extends('layouts.app')

@section('title', 'Data Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Booking Saya</h3>
    <a href="/bookings/create" class="btn btn-primary">+ Tambah Booking</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                        <td>
                            <span class="badge bg-{{ $booking->status_pembayaran == 'Lunas' ? 'success' : 'warning' }}">
                                {{ $booking->status_pembayaran }}
                            </span>
                        </td>
                        <td>
                            <a href="/bookings/{{ $booking->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                            <form action="/bookings/{{ $booking->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data booking.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection