@extends('layouts.navbar')

@section('content')
<!-- Custom CSS -->
<style>
    :root {
        --primary-color: #4B3D2D;
        --secondary-color: #B8A088;
        --accent-color: #F3A738;
        --text-light: #F5F5F5;
        --text-dark: #333333;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    h1, h2, h3, h4, h5 {
        font-family: 'Playfair Display', serif;
    }
    
    /* Hero Section */
    .hero {
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        color: white;
        text-align: center;
    }
    
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .hero p {
        font-size: 1.25rem;
        font-weight: 300;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }
    
    /* Sections */
    section {
        padding: 5rem 0;
    }
    
    .section-title {
        position: relative;
        margin-bottom: 3rem;
        padding-bottom: 1rem;
        text-align: center;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 70px;
        height: 3px;
        background-color: var(--accent-color);
    }
    
    /* About Section */
    .about-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .about-text {
        padding: 2rem;
    }
    
    /* Program Cards */
    .program-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .program-image {
        height: 250px;
        object-fit: cover;
    }
    
    .program-card .card-body {
        padding: 1.5rem;
    }
    
    .program-card .card-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }
    
    .program-card .card-text {
        color: #666;
        margin-bottom: 1.5rem;
    }
    
    /* Activities Section */
    .activities-slider .carousel-item {
        height: 500px;
    }
    
    .activities-slider img {
        height: 100%;
        object-fit: cover;
    }
    
    .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        border-radius: 10px;
        padding: 20px;
        bottom: 40px;
    }
    
    /* Custom buttons */
    .btn-custom {
        background-color: var(--accent-color);
        color: var(--text-dark);
        font-weight: 500;
        padding: 12px 30px;
        border-radius: 30px;
        transition: all 0.3s ease;
        border: 2px solid var(--accent-color);
    }
    
    .btn-custom:hover {
        background-color: transparent;
        color: var(--accent-color);
        transform: scale(1.05);
    }
    
    .btn-outline-custom {
        background-color: transparent;
        color: var(--accent-color);
        font-weight: 500;
        padding: 12px 30px;
        border-radius: 30px;
        transition: all 0.3s ease;
        border: 2px solid var(--accent-color);
    }
    
    .btn-outline-custom:hover {
        background-color: var(--accent-color);
        color: var(--text-dark);
        transform: scale(1.05);
    }
    
    /* Gallery */
    .gallery {
        background-color: #f9f9f9;
    }
    
    .gallery-item {
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    .gallery-item img {
        transition: all 0.5s ease;
        height: 250px;
        width: 100%;
        object-fit: cover;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        color: white;
        padding: 15px;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .gallery-item:hover .gallery-caption {
        opacity: 1;
    }
    
    /* Contact */
    .contact-info i {
        color: var(--accent-color);
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    
    .contact-form input,
    .contact-form textarea {
        border-radius: 0;
        border: 1px solid #ddd;
        padding: 12px 15px;
    }
    
    .contact-form input:focus,
    .contact-form textarea:focus {
        box-shadow: none;
        border-color: var(--accent-color);
    }
</style>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<!-- Include AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Include Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<!-- Hero Section -->
<div class="hero" style="background-image: url('{{ asset('images/kebudayaan.jpg') }}');">
    <div class="container hero-content">
        <h1 data-aos="fade-down" data-aos-delay="100">
            <span id="typed-text"></span>
        </h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="300">Bersama Kita Lestarikan Warisan Budaya Indonesia</p>
        <div data-aos="zoom-in" data-aos-delay="600">
            <a href="{{ route('museum.index') }}" class="btn btn-custom me-3">Jelajahi Museum</a>
            <a href="#program" class="btn btn-outline-custom">Program Kami</a>
        </div>
    </div>
</div>

<!-- About Section -->
<section id="about" class="about">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Tentang Kami</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                <div class="about-image">
                    <img src="{{ asset('images/bglandingpage1.jpg') }}" alt="Tentang Kami" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="about-text">
                    <h3>Kementerian Kebudayaan</h3>
                    <p class="lead">Melestarikan, mengembangkan, dan mempromosikan kebudayaan Indonesia yang kaya dan beragam.</p>
                    <p>Kementerian Kebudayaan berkomitmen untuk melindungi dan memperkenalkan kekayaan warisan budaya Indonesia kepada masyarakat melalui museum yang informatif dan interaktif. Kami bertujuan untuk menjaga identitas budaya nasional sambil menginspirasi generasi masa depan untuk menghargai dan memperkuat akar budaya mereka.</p>
                    <a href="{{ route('about') }}" class="btn btn-custom mt-3">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Section -->
<section id="program" class="program bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Program Unggulan</h2>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="program-card card">
                    <img src="{{ asset('images/Program unggulan 1.jpg') }}" alt="Reimajinasi MNI" class="program-image">
                    <div class="card-body">
                        <h5 class="card-title">Reimajinasi MNI</h5>
                        <p class="card-text">Reimajinasi MNI bertujuan untuk memperluas cakupan koleksi dan narasi museum, mulai dari sejarah prasejarah hingga perjuangan kemerdekaan.</p>
                        <a href="#" class="btn btn-outline-custom">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="program-card card">
                    <img src="{{ asset('images/Program unggulan 2.jpg') }}" alt="Revitalisasi" class="program-image">
                    <div class="card-body">
                        <h5 class="card-title">Revitalisasi</h5>
                        <p class="card-text">Revitalisasi bertujuan untuk memperkuat identitas dan relevansi museum bagi masyarakat, termasuk melalui ruang pamer imersif dan lomba cerdas cermat museum.</p>
                        <a href="#" class="btn btn-outline-custom">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="program-card card">
                    <img src="{{ asset('images/Program unggulan 3.jpg') }}" alt="Program Edukasi yang Inovatif" class="program-image">
                    <div class="card-body">
                        <h5 class="card-title">Program Edukasi Inovatif</h5>
                        <p class="card-text">Program kolaborasi internasional dan publikasi di berbagai platform untuk menjangkau lebih luas masyarakat dan mengedukasi tentang kekayaan budaya Indonesia.</p>
                        <a href="#" class="btn btn-outline-custom">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Activities Section -->
<section id="activities" class="activities">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Kegiatan Terbaru</h2>
        <div id="activitiesCarousel" class="carousel slide activities-slider" data-bs-ride="carousel" data-aos="fade-up" data-aos-delay="200">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#activitiesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#activitiesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#activitiesCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/Museum Nasional Indonesia.jpg') }}" class="d-block w-100" alt="Museum Nasional Indonesia">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Museum Nasional Indonesia</h5>
                        <p>Pameran artefak sejarah dan budaya dari seluruh nusantara</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/Museum Sejarah Fatahillah.jpg') }}" class="d-block w-100" alt="Museum Sejarah Fatahillah">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Museum Sejarah Fatahillah</h5>
                        <p>Menelusuri sejarah Jakarta dari masa kolonial hingga modern</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/Museum Wayang.jpg') }}" class="d-block w-100" alt="Museum Wayang">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Museum Wayang</h5>
                        <p>Melestarikan seni pertunjukan tradisional Indonesia</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#activitiesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#activitiesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('activities.index') }}" class="btn btn-custom">Lihat Semua Kegiatan</a>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<section id="gallery" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Galeri Museum</h2>

        <div class="swiper mySwiper position-relative p-2 bg-white rounded shadow">
            <div class="swiper-wrapper">
                @foreach($museums->where('gambar', '!=', null)->take(12) as $museum)
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <!-- Gambar dengan Tautan ke Halaman Show -->
                            <a href="{{ route('museum.show', $museum->id) }}" class="position-relative overflow-hidden d-block">
                                <!-- Image -->
                                <img src="{{ asset('storage/' . $museum->gambar) }}" alt="{{ $museum->nama }}"
                                     class="img-fluid gallery-image" style="object-fit: cover; height: 200px; width: 100%;">
                                <!-- Nama Museum sebagai Overlay Text -->
                                <div class="overlay-text position-absolute bottom-0 start-0 w-100 p-4">
                                    <h5 class="fw-bold">{{ $museum->nama }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Navigasi yang Diperbarui -->
            <button class="carousel-control-prev swiper-button-prev" type="button" data-bs-target="#galeri" data-bs-slide="prev">
                <span class="carousel-control-prev-icon swiper-button-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next swiper-button-next" type="button" data-bs-target="#galeri" data-bs-slide="next">
                <span class="carousel-control-next-icon swiper-button-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Pagination -->
            <div class="swiper-pagination mt-3"></div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Swiper Configuration -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });
</script>

<!-- Include Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<style>
    /* Untuk mengatur gambar agar sesuai dengan ukuran card */
    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Menyesuaikan gambar agar menutupi area dengan proporsional */
        transition: transform 0.3s ease-in-out;
    }

    /* Efek zoom in pada gambar saat hover */
    .swiper-slide a:hover .gallery-image {
        transform: scale(1.1); /* Zoom in gambar */
    }

    /* Menambahkan overlay text di atas gambar */
    .overlay-text {
        background-color: rgba(0, 0, 0, 0.5); /* Transparan hitam untuk efek overlay */
        color: white;
        opacity: 0;
        bottom: 0;
        left: 0;
        padding: 15px;
        text-align: center;
        transition: opacity 0.3s ease-in-out;
    }

    /* Efek hover untuk munculnya nama museum */
    .swiper-slide a:hover .overlay-text {
        opacity: 1;
    }

    /* Styling Nama Museum */
    .overlay-text h5 {
        font-size: 1.4rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* Styling untuk tombol navigasi */
    .swiper-button-prev, .swiper-button-next {
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        font-size: 1.5rem;
        padding: 12px;
        border-radius: 50%;
        z-index: 10;
    }

    .swiper-button-prev:hover, .swiper-button-next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }
</style>





<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Hubungi Kami</h2>
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                <div class="contact-info">
                    <div class="mb-4">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Alamat</h5>
                        <p>Jl. Jenderal Sudirman No. 123, Jakarta</p>
                    </div>
                    <div class="mb-4">
                        <i class="fas fa-phone"></i>
                        <h5>Telepon</h5>
                        <p>(021) 1234-5678</p>
                    </div>
                    <div class="mb-4">
                        <i class="fas fa-envelope"></i>
                        <h5>Email</h5>
                        <p>info@museumindonesia.id</p>
                    </div>
                    <div class="social-links">
                        <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                <form class="contact-form">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Nama Anda">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" placeholder="Email Anda">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Subjek">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="5" placeholder="Pesan Anda"></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Include AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        once: true,
        duration: 1000,
        delay: 100,
    });

    // Typed.js animation
    document.addEventListener('DOMContentLoaded', function() {
        var typed = new Typed('#typed-text', {
            strings: ["Merayakan Keberagaman Budaya Indonesia", "Melestarikan Warisan Bangsa", "Mengenal Sejarah dan Identitas Kita"],
            typeSpeed: 50,
            backSpeed: 25,
            backDelay: 2000,
            loop: true
        });
    });
</script>
@endsection