@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Form Edit Booking</h5>
            </div>
            <div class="card-body">
                <form action="/bookings/{{ $booking->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror" value="{{ old('nama_pemesan', $booking->nama_pemesan) }}" required>
                            @error('nama_pemesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Lapangan</label>
                            <select name="jenis_lapangan" class="form-select @error('jenis_lapangan') is-invalid @enderror" required>
                                <option value="Badminton" {{ old('jenis_lapangan', $booking->jenis_lapangan) == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                                <option value="Futsal" {{ old('jenis_lapangan', $booking->jenis_lapangan) == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                                <option value="Basket" {{ old('jenis_lapangan', $booking->jenis_lapangan) == 'Basket' ? 'selected' : '' }}>Basket</option>
                                <option value="Voli" {{ old('jenis_lapangan', $booking->jenis_lapangan) == 'Voli' ? 'selected' : '' }}>Voli</option>
                            </select>
                            @error('jenis_lapangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Booking</label>
                            <input type="date" name="tanggal_booking" class="form-control @error('tanggal_booking') is-invalid @enderror" value="{{ old('tanggal_booking', $booking->tanggal_booking) }}" required>
                            @error('tanggal_booking') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', $booking->jam_mulai) }}" required>
                            @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', $booking->jam_selesai) }}" required>
                            @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Bayar (Rp)</label>
                            <input type="number" name="total_bayar" class="form-control @error('total_bayar') is-invalid @enderror" value="{{ old('total_bayar', $booking->total_bayar) }}" required>
                            @error('total_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-select @error('status_pembayaran') is-invalid @enderror" required>
                                <option value="Lunas" {{ old('status_pembayaran', $booking->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="DP" {{ old('status_pembayaran', $booking->status_pembayaran) == 'DP' ? 'selected' : '' }}>DP</option>
                                <option value="Belum Lunas" {{ old('status_pembayaran', $booking->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            </select>
                            @error('status_pembayaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="/bookings" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-warning">Update Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection