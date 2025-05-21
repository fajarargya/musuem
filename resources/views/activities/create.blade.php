@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Kegiatan Baru</h2>
    <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Judul Kegiatan</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="museum">Museum</label>
            <input type="text" class="form-control" id="museum" name="museum" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="time">Waktu</label>
            <input type="time" class="form-control" id="time" name="time" required>
        </div>

        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="ticket_price">Harga Tiket</label>
            <input type="number" class="form-control" id="ticket_price" name="ticket_price" required>
        </div>

        <div class="form-group">
            <label for="contact">Kontak</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>

        <div class="form-group">
            <label for="registration_link">Tautan Pendaftaran</label>
            <input type="url" class="form-control" id="registration_link" name="registration_link" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
