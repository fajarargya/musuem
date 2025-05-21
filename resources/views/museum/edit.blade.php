@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Museum</h1>

    <form action="{{ route('museum.update', $museum->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Museum</label>
            <input type="text" name="nama" class="form-control" value="{{ $museum->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ $museum->provinsi }}" required>
        </div>

        <div class="mb-3">
            <label>Kota</label>
            <input type="text" name="kota" class="form-control" value="{{ $museum->kota }}" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Koleksi</label>
            <input type="number" name="jumlah_koleksi" class="form-control" value="{{ $museum->jumlah_koleksi }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Pemilik</label>
            <input type="text" name="jenis_pemilik" class="form-control" value="{{ $museum->jenis_pemilik }}" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control" value="{{ $museum->pemilik }}" required>
        </div>

        <div class="mb-3">
            <label>Tipe Akhir</label>
            <input type="text" name="tipe_akhir" class="form-control" value="{{ $museum->tipe_akhir }}" required>
        </div>

        <div class="mb-3">
            <label>Nomor Pendaftaran</label>
            <input type="text" name="nomor_pendaftaran" class="form-control" value="{{ $museum->nomor_pendaftaran }}" required>
        </div>

        <div class="mb-3">
            <label>Logo Museum (opsional)</label>
            <input type="file" name="gambar" class="form-control">
            @if($museum->gambar)
                <small>Gambar saat ini:</small><br>
                <img src="{{ asset('storage/' . $museum->gambar) }}" class="img-fluid mt-2" alt="{{ $museum->nama }}" style="max-height: 150px;">
            @endif
        </div>

        <!-- Latitude & Longitude -->
        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $museum->latitude }}" required>
        </div>

        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" id="longitude" name="longitude" class="form-control" value="{{ $museum->longitude }}" required>
        </div>

        <!-- Peta -->
        <div class="mb-3" id="map" style="height: 400px;"></div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <!-- Tombol Kembali -->
        <a href="{{ route('museum.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([{{ $museum->latitude ?? -6.1751 }}, {{ $museum->longitude ?? 106.8650 }}], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker([{{ $museum->latitude ?? -6.1751 }}, {{ $museum->longitude ?? 106.8650 }}], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function(e) {
        const latlng = e.target.getLatLng();
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });
</script>
@endsection
