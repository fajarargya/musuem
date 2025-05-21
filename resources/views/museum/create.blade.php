@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Museum</h1>

    <form action="{{ route('museum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Museum</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kota</label>
            <input type="text" name="kota" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Koleksi</label>
            <input type="number" name="jumlah_koleksi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Pemilik</label>
            <input type="text" name="jenis_pemilik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipe Akhir</label>
            <input type="text" name="tipe_akhir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nomor Pendaftaran</label>
            <input type="text" name="nomor_pendaftaran" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Logo Museum (opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <!-- Latitude & Longitude -->
        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" id="longitude" name="longitude" class="form-control" required>
        </div>

        <!-- Leaflet Map -->
        <div class="mb-3">
            <label>Pilih Lokasi di Peta:</label>
            <div id="map" style="height: 400px;" class="rounded shadow-sm"></div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>

        <!-- Tombol Kembali -->
        <a href="{{ route('museum.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Koordinat default (Jakarta)
    const defaultLat = -6.1751;
    const defaultLng = 106.8650;

    const map = L.map('map').setView([defaultLat, defaultLng], 13);

    // Tambahkan layer dari OSM
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker
    const marker = L.marker([defaultLat, defaultLng], {draggable:true}).addTo(map);

    // Update input saat marker dipindah
    marker.on('dragend', function (e) {
        const latLng = marker.getLatLng();
        document.getElementById("latitude").value = latLng.lat.toFixed(7);
        document.getElementById("longitude").value = latLng.lng.toFixed(7);
    });

    // Klik di peta untuk pindah marker
    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        document.getElementById("latitude").value = e.latlng.lat.toFixed(7);
        document.getElementById("longitude").value = e.latlng.lng.toFixed(7);
    });

    // Set nilai awal di form
    document.getElementById("latitude").value = defaultLat;
    document.getElementById("longitude").value = defaultLng;
</script>
@endsection
