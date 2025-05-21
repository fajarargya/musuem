<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Direktori Museum Indonesia</title>

    <!-- CSS and Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <!-- Include custom CSS -->
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
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: var(--text-light);
            font-weight: 600;
        }

        .navbar-nav .nav-link:hover {
            color: var(--accent-color);
        }

        .footer {
            background-color: var(--primary-color);
            color: var(--text-light);
            padding: 2rem 0;
        }

        .footer a {
            color: var(--text-light);
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--accent-color);
        }

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
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 2rem;
        }

        .hero-section h1 {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .search-container {
            margin-bottom: 3rem;
        }

        .search-form {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .search-input {
            border: none;
            font-size: 1rem;
            padding: 1.25rem 1.5rem;
            background-color: transparent;
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
        }

        .museum-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            cursor: pointer;
        }

        .museum-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
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
        }

        .museum-location {
            color: #777;
            font-size: 0.9rem;
        }

        .admin-buttons {
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
        }

        .btn-custom {
            background-color: var(--accent-color);
            color: var(--text-dark);
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
        }

        .btn-custom:hover {
            background-color: transparent;
            color: var(--accent-color);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('museum.index') }}">
                    DIREKTORI MUSEUM INDONESIA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('activities.index') }}">Kegiatan Terbaru</a></li>
                        <li class="nav-item">
                            @guest
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            @else
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container my-5">
            @yield('content')
        </main>

        <footer class="footer text-center">
            <div class="container">
                <p>&copy; 2025 Direktori Museum Indonesia. All Rights Reserved.</p>
                <p><a href="{{ route('about') }}">Tentang Kami</a> | <a href="{{ route('contact') }}">Kontak</a></p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init({ once: true, duration: 800, delay: 100 });
        </script>

    </body>
</html>