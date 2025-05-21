@extends('layouts.app')

@section('styles')
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Hero Overlay & Text */
        .hero-activities {
            position: relative;
            overflow: hidden;
        }
        .hero-activities .overlay {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .hero-title {
            letter-spacing: 2px;
        }
        /* Card Hover Effects */
        .activity-card {
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,.15);
        }
        .activity-card img {
            transition: transform .5s ease;
        }
        .activity-card img:hover {
            transform: scale(1.1);
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section
    class="hero-activities position-relative text-white d-flex align-items-center"
    style="height: 400px; background: url('{{ asset('images/index kegiatan.png') }}') center/cover no-repeat;"
    >
    <!-- Overlay lebih redup -->
    <div
        class="overlay position-absolute top-0 start-0 w-100 h-100"
        style="background-color: rgba(0, 0, 0, 0.55);"
    ></div>

    <div
        class="container text-center position-relative"
        data-aos="fade-down"
        data-aos-duration="1200"
    >
        <h1 class="display-3 fw-bold hero-title">Kegiatan Terbaru</h1>
        <p class="lead mt-3">Temukan berbagai kegiatan menarik dan eksklusif di museum kami.</p>
    </div>
    </section>


    <!-- Activities Grid -->
    <section id="activities" class="activities py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @foreach($activities as $activity)
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card activity-card rounded-4 overflow-hidden">
                            <a href="{{ route('activities.show', $activity->id) }}">
                                <img src="{{ asset('storage/' . $activity->image) }}" 
                                     class="card-img-top img-fluid" 
                                     alt="{{ $activity->title }}" 
                                     style="height: 220px; object-fit: cover;">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">
                                    <a href="{{ route('activities.show', $activity->id) }}" class="text-dark text-decoration-none">
                                        {{ Str::limit($activity->title, 50) }}
                                    </a>
                                </h5>
                                <small class="text-muted d-block mb-3">{{ $activity->museum }}</small>
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-sm btn-outline-warning me-2">Edit</a>
                                        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="text-center mt-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="{{ route('activities.create') }}" 
                        class="btn btn-lg shadow-lg px-5 py-3"
                        style="background-color: #8B4513; color: #fff; border: none;">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Kegiatan Baru
                        </a>
                    </div>
                @endif
            @endauth

        </div>
    </section>
@endsection

@section('scripts')
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ once: true });
        });
    </script>
@endsection
