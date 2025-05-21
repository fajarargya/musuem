@extends('layouts.app')

@section('content')

<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container py-5">

    <!-- Tombol Kembali -->
    <a href="{{ route('museum.index') }}" class="btn btn-outline-dark mb-4 shadow-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>

    <!-- Hero Section -->
    <div class="row mb-4 rounded shadow-lg overflow-hidden hero-section" style="height: 400px;">
        <div class="col-12 d-flex justify-content-center align-items-center text-white text-center" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('storage/' . ($museum->gambar ?? 'default-image.jpg')) }}'); background-size: cover; background-position: center;">
            <h1 class="display-4 fw-bold" data-aos="zoom-in">{{ $museum->nama }}</h1>
        </div>
    </div>


    <!-- Info Panel -->
    <div class="row">
        <!-- Gambar -->
        <div class="col-md-6 mb-4" data-aos="fade-right">
            @if($museum->gambar)
                <img src="{{ asset('storage/' . $museum->gambar) }}" class="img-fluid rounded shadow museum-image" alt="{{ $museum->nama }}">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">
                    <span class="text-muted">Tidak ada gambar</span>
                </div>
            @endif
        </div>

        <!-- Info Text -->
        <div class="col-md-6" data-aos="fade-left">
            <div class="bg-white rounded p-4 shadow-sm">
                <h3 class="mb-3">Informasi Museum</h3>
                <ul class="list-unstyled fs-5">
                    <li class="mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i><strong>Provinsi:</strong> {{ $museum->provinsi }}</li>
                    <li class="mb-3"><i class="fas fa-city text-info me-2"></i><strong>Kota:</strong> {{ $museum->kota }}</li>
                    <li class="mb-3"><i class="fas fa-book text-primary me-2"></i><strong>Jumlah Koleksi:</strong> {{ $museum->jumlah_koleksi }}</li>
                    <li class="mb-3"><i class="fas fa-user text-warning me-2"></i><strong>Jenis Pemilik:</strong> {{ $museum->jenis_pemilik }}</li>
                    <li class="mb-3"><i class="fas fa-user-tie text-secondary me-2"></i><strong>Pemilik:</strong> {{ $museum->pemilik }}</li>
                    <li class="mb-3"><i class="fas fa-tags text-success me-2"></i><strong>Tipe Akhir:</strong> {{ $museum->tipe_akhir }}</li>
                    <li class="mb-3"><i class="fas fa-cogs text-muted me-2"></i><strong>Nomor Pendaftaran:</strong> {{ $museum->nomor_pendaftaran }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Peta -->
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
            <h4 class="mb-3"><i class="fas fa-map text-success me-2"></i> Lokasi Museum</h4>
            @if(!empty($museum->latitude) && !empty($museum->longitude))
                <div class="rounded shadow overflow-hidden">
                    <iframe 
                        width="100%" 
                        height="350" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0"
                        src="https://www.openstreetmap.org/export/embed.html?bbox={{ $museum->longitude - 0.002 }},{{ $museum->latitude - 0.002 }},{{ $museum->longitude + 0.002 }},{{ $museum->latitude + 0.002 }}&layer=mapnik&marker={{ $museum->latitude }},{{ $museum->longitude }}">
                    </iframe>
                </div>
                <small>
                    <a href="https://www.openstreetmap.org/?mlat={{ $museum->latitude }}&mlon={{ $museum->longitude }}" target="_blank">
                        Lihat peta lebih besar di OpenStreetMap
                    </a>
                </small>
            @else
                <p class="text-muted">Koordinat lokasi belum tersedia.</p>
            @endif
        </div>
    </div>

    <!-- Galeri Museum Lainnya -->
    <div class="container">
    @if($relatedMuseums->count())
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
            <h4 class="mb-4"><i class="fas fa-image text-primary me-2"></i> Galeri Museum Lainnya</h4>

            <div id="relatedMuseumCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($relatedMuseums->chunk(3) as $index => $museumChunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach($museumChunk as $related)
                                    <div class="col-md-4">
                                        <a href="{{ route('museum.show', $related->id) }}" class="text-decoration-none text-dark">
                                            <div class="card h-100 shadow-sm border-0">
                                                @if($related->gambar)
                                                    <img src="{{ asset('storage/' . $related->gambar) }}" class="card-img-top museum-image" alt="{{ $related->nama }}">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                        <span class="text-muted">Tidak ada gambar</span>
                                                    </div>
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $related->nama }}</h5>
                                                    <p class="card-text text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i> {{ $related->kota }}, {{ $related->provinsi }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigasi -->
                <button class="carousel-control-prev" type="button" data-bs-target="#relatedMuseumCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#relatedMuseumCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>

</div>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000 });
</script>
<style>
    /* Untuk mengatur gambar agar sesuai dengan ukuran card */
    .museum-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Menyesuaikan gambar agar menutupi area dengan proporsional */
    }

    /* Hero section - agar gambar memenuhi area dengan ukuran tetap */
    .hero-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

@endsection
@push('scripts')
<script>
    // Aktifkan carousel otomatis
    var myCarousel = document.querySelector('#relatedMuseumCarousel');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3000,  // Slide berpindah setiap 3 detik
        ride: 'carousel' // Aktifkan rotasi otomatis saat halaman dimuat
    });
</script>
@endpush
