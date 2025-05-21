@extends('layouts.app')

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
        background-color: #fbfbfb;
    }
    
    h1, h2, h3, h4, h5 {
        font-family: 'Playfair Display', serif;
    }
    
    /* Hero Section */
    .hero-section {
        position: relative;
        height: 400px;
        margin-bottom: 3rem;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6));
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 2rem;
    }
    
    .hero-section h1 {
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 1rem;
    }
    
    .hero-section p {
        font-weight: 300;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        max-width: 700px;
        margin: 0 auto;
    }
    
    /* Search Section */
    .search-container {
        margin-bottom: 3rem;
    }
    
    .search-form {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .search-form:focus-within {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    
    .search-input {
        border: none;
        font-size: 1rem;
        padding: 1.25rem 1.5rem;
        background-color: transparent;
    }
    
    .search-input:focus {
        box-shadow: none;
        outline: none;
    }
    
    .search-button {
        background-color: var(--accent-color);
        color: var(--text-dark);
        font-weight: 500;
        padding: 0.75rem 2rem;
        border: none;
        transition: all 0.3s ease;
    }
    
    .search-button:hover {
        background-color: #e09730;
        transform: translateX(3px);
    }
    
    /* Museum Cards */
    .museum-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        height: 100%;
        cursor: pointer;
    }
    
    .museum-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .museum-image {
        height: 220px;
        object-fit: cover;
        transition: all 0.5s ease;
    }
    
    .museum-card:hover .museum-image {
        transform: scale(1.05);
    }
    
    .museum-details {
        padding: 1.5rem;
    }
    
    .museum-name {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    
    .museum-location {
        color: #777;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }
    
    .museum-location i {
        color: var(--accent-color);
        margin-right: 0.5rem;
    }
    
    /* Admin Buttons */
    .admin-buttons {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    
    .btn-custom {
        background-color: var(--accent-color);
        color: var(--text-dark);
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        border: 2px solid var(--accent-color);
    }
    
    .btn-custom:hover {
        background-color: transparent;
        color: var(--accent-color);
    }
    
    .btn-edit {
        color: var(--accent-color);
        border: 1px solid var(--accent-color);
        background-color: transparent;
        transition: all 0.3s ease;
    }
    
    .btn-edit:hover {
        background-color: var(--accent-color);
        color: white;
    }
    
    .btn-delete {
        color: #dc3545;
        border: 1px solid #dc3545;
        background-color: transparent;
        transition: all 0.3s ease;
    }
    
    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 1.5rem;
    }
    
    /* Add Museum Button */
    .add-museum-btn {
        margin-top: 3rem;
        text-align: center;
    }
    
    .add-button {
        background: linear-gradient(45deg, var(--primary-color), #6F4E37);
        color: white;
        font-weight: 500;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
    }
    
    .add-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    /* Alert */
    .alert-success {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
        border: none;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 2rem;
    }
    
    /* Animation */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    
    .zoom-in {
        animation: zoomIn 0.6s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes zoomIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .favorite-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    border: none;
    font-size: 24px;
    color: gold;
    cursor: pointer;
    z-index: 10;
    }

    .favorite-btn:hover {
        transform: scale(1.1);
    }
</style>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<!-- Include AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Include Animate.css -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<div class="container py-5">
    <!-- Hero Section -->
    <div class="hero-section animate__animated animate__fadeIn" style="background-image: url('{{ asset('images/Museum Index.png') }}');">
        <div class="d-flex justify-content-center align-items-center text-center text-white h-100 hero-content">
            <div>
                <h1 class="display-4 fw-bold animate__animated animate__zoomIn">
                    <i class="fas fa-landmark me-2"></i>DIREKTORI MUSEUM INDONESIA
                </h1>
                <p class="fs-5 mt-3 animate__animated animate__fadeIn animate__delay-1s">
                    Temukan, Jelajahi, dan Kenali Warisan Budaya Nusantara Melalui Koleksi Museum Terbaik Indonesia
                </p>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="row justify-content-center search-container" data-aos="fade-up">
        <div class="col-md-8">
            <form action="{{ route('museum.index') }}" method="GET" class="d-flex search-form">
                <input type="text" name="search" class="form-control search-input" 
                       placeholder="Cari museum berdasarkan nama atau kota..." 
                       value="{{ request('search') }}" aria-label="Search museums">
                <button class="search-button">
                    <i class="fas fa-search me-2"></i>Cari
                </button>
            </form>
        </div>
    </div>
    @if(request('search'))
    <div class="text-center my-3">
        <p class="text-muted">Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
    </div>
    @endif

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success text-center animate__animated animate__fadeIn">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Grid Museum -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mb-5">
        @forelse($museums as $museum)
            <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="museum-card">
                    <a href="{{ route('museum.show', $museum->id) }}" class="text-decoration-none">
                        <div class="position-relative overflow-hidden">
                            @if($museum->gambar)
                                <img src="{{ asset('storage/' . $museum->gambar) }}" 
                                    alt="{{ $museum->nama }}" class="museum-image w-100">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center museum-image w-100">
                                    <i class="fas fa-image text-muted fa-2x"></i>
                                </div>
                            @endif

                            <!-- Tombol Favorit -->
                            @auth
                                <form action="{{ route('museum.toggleFavorite', $museum->id) }}" method="POST" class="favorite-form">
                                    @csrf
                                    <button type="submit" class="favorite-btn" title="Favorit">
                                        @if(auth()->user()->favoriteMuseums->contains($museum->id))
                                            ★ <!-- sudah difavoritkan -->
                                        @else
                                            ☆ <!-- belum difavoritkan -->
                                        @endif
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <div class="museum-details">
                            <h5 class="museum-name">{{ $museum->nama }}</h5>
                            <div class="museum-location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $museum->kota }}, {{ $museum->provinsi }}
                            </div>
                        </div>
                    </a>

                    <!-- Admin Controls -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="admin-buttons">
                            <a href="{{ route('museum.edit', $museum->id) }}" class="btn btn-sm btn-edit rounded-pill px-3">
                                <i class="fas fa-pencil-alt me-1"></i>Edit
                            </a>
                            <form action="{{ route('museum.destroy', $museum->id) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus museum ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-delete rounded-pill px-3">
                                    <i class="fas fa-trash-alt me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state animate__animated animate__fadeIn">
                    <i class="fas fa-search"></i>
                    <h4>Tidak Ada Museum Ditemukan</h4>
                    <p class="text-muted">Tidak ada museum yang sesuai dengan kriteria pencarian Anda. Silakan coba pencarian lain.</p>
                </div>
            </div>
        @endforelse
    </div>


    <!-- Pagination -->
    @if($museums->hasPages())
        <div class="d-flex justify-content-center mt-4" data-aos="fade-up">
            {{ $museums->links('pagination::bootstrap-5') }}
        </div>
    @endif

    <!-- Tombol Tambah Museum -->
    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="add-museum-btn" data-aos="fade-up">
            <a href="{{ route('museum.create') }}" class="add-button">
                <i class="fas fa-plus-circle me-2"></i>Tambah Museum Baru
            </a>
        </div>
    @endif
</div>

<!-- Include AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        once: true,
        duration: 800,
        delay: 100
    });
</script>
@endsection