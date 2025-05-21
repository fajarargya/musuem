@extends('layouts.app')

@section('content')
<section id="activity-detail" class="activity-detail pt-0">
    <!-- Hero Banner -->
    <div class="activity-hero text-white d-flex align-items-center justify-content-center text-center"
         style="background-image: url('{{ asset('storage/' . $activity->image) }}'); background-size: cover; background-position: center; height: 300px;">
        <div class="bg-dark bg-opacity-50 w-100 h-100 d-flex flex-column justify-content-center">
            <h1 class="display-4 fw-bold" data-aos="fade-down">{{ $activity->title }}</h1>
            <h4 class="text-light" data-aos="fade-up">{{ $activity->museum }}</h4>
        </div>
    </div>

    <!-- Foto Utama -->
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="zoom-in">
                <img src="{{ asset('storage/' . $activity->image) }}"
                     alt="{{ $activity->title }}"
                     class="img-fluid rounded shadow-lg w-100"
                     style="max-height: 500px; object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Konten -->
    <div class="container pb-5">
        <!-- Informasi Kegiatan -->
        <div class="row mb-4">
            <div class="col-md-6" data-aos="fade-right">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p><i class="bi bi-calendar-event me-2"></i><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($activity->date)->format('d F Y') }}</p>
                        <p><i class="bi bi-clock me-2"></i><strong>Jam:</strong> {{ $activity->time }}</p>
                        <p><i class="bi bi-geo-alt me-2"></i><strong>Lokasi:</strong> {{ $activity->location }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p><i class="bi bi-cash-coin me-2"></i><strong>Harga Tiket:</strong> {{ $activity->ticket_price }}</p>
                        <p><i class="bi bi-telephone me-2"></i><strong>Kontak:</strong> {{ $activity->contact }}</p>
                        <p><i class="bi bi-link-45deg me-2"></i><strong>Daftar Sekarang:</strong>
                            <a href="{{ $activity->registration_link }}" target="_blank" class="btn btn-outline-primary btn-sm">Klik di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimoni -->
        @if(!empty($testimonials) && count($testimonials) > 0)
            <div class="mb-5" data-aos="fade-up">
                <h4 class="mb-3">Testimoni Pengunjung</h4>
                <div class="row g-3">
                    @foreach($testimonials as $testimonial)
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p>"{{ $testimonial->content }}"</p>
                                        <footer class="blockquote-footer">{{ $testimonial->author }}</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Kegiatan Lainnya (carousel kecil, 1 foto per slide) -->
        @if($relatedActivities->count() > 0)
        <div class="mb-5" data-aos="fade-up">
            <h4 class="mb-3">Kegiatan Lainnya</h4>
            <div id="relatedCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($relatedActivities as $index => $related)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="card mx-auto" style="width: 75rem;">
                            <a href="{{ route('activities.show', $related->id) }}">
                                <img
                                    src="{{ asset('storage/' . $related->image) }}"
                                    class="card-img-top"
                                    alt="{{ $related->title }}"
                                    style="height: 530px; object-fit: cover;"
                                >
                            </a>
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title flex-grow-1">{{ $related->title }}</h5>
                                <a href="{{ route('activities.show', $related->id) }}" class="btn btn-outline-secondary btn-sm mt-auto">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#relatedCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#relatedCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Selanjutnya</span>
                </button>
            </div>
        </div>
        @endif

        <!-- Tombol Kembali -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('activities.index') }}" class="btn btn-secondary btn-lg shadow">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .activity-hero {
        position: relative;
        overflow: hidden;
    }

    .activity-hero h1,
    .activity-hero h4 {
        z-index: 2;
    }

    .activity-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease-in-out;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    /* Tambahan agar carousel tampil rapi */
    .carousel-item {
        transition: transform 0.6s ease;
    }

    .carousel-inner {
        min-height: 300px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0,0,0,0.5); /* kasih warna supaya keliatan */
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    /* Custom agar tombol carousel relatedCarousel menempel pas di sisi gambar */
    #relatedCarousel .carousel-control-prev,
    #relatedCarousel .carousel-control-next {
        width: 5%;
        top: 50%;
        transform: translateY(-50%);
    }

    #relatedCarousel .carousel-control-prev {
        left: 0;
    }

    #relatedCarousel .carousel-control-next {
        right: 0;
    }

    #relatedCarousel .carousel-control-prev-icon,
    #relatedCarousel .carousel-control-next-icon {
        width: 30px;
        height: 30px;
        background-size: 30px 30px;
    }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Carousel Kegiatan Lainnya
    var relatedCarousel = document.querySelector('#relatedCarousel');
    if (relatedCarousel) {
      new bootstrap.Carousel(relatedCarousel, {
        interval: 3000,
        ride: 'carousel',
        wrap: true,
        pause: false
      });
    }
  });
</script>
@endsection
