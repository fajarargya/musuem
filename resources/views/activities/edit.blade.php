@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kegiatan</h2>
    <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Judul Kegiatan</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $activity->title }}" required>
        </div>

        <div class="mb-3">
            <label for="museum" class="form-label">Museum</label>
            <input type="text" class="form-control" id="museum" name="museum" value="{{ $activity->museum }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Kegiatan</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset($activity->image) }}" class="img-fluid mt-2" alt="Current Image" style="width: 200px;">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal Kegiatan</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $activity->date }}" required>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Jam Kegiatan</label>
            <input type="time" class="form-control" id="time" name="time" value="{{ $activity->time }}" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi Kegiatan</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $activity->location }}" required>
        </div>

        <div class="mb-3">
            <label for="ticket_price" class="form-label">Harga Tiket</label>
            <input type="number" class="form-control" id="ticket_price" name="ticket_price" value="{{ $activity->ticket_price }}" required>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Kontak</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ $activity->contact }}" required>
        </div>

        <div class="mb-3">
            <label for="registration_link" class="form-label">Link Pendaftaran</label>
            <input type="url" class="form-control" id="registration_link" name="registration_link" value="{{ $activity->registration_link }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
