<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Indonesia - Jelajahi Warisan Budaya</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
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
            overflow-x: hidden;
            background-color: #fbfbfb;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
        }
        
        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #6F4E37);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 6px 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .logo-img {
            height: 50px;
            margin-right: 12px;
            transition: transform 0.4s ease;
        }
        
        .navbar-brand:hover .logo-img {
            transform: rotate(5deg);
        }
        
        .navbar-brand,
        .navbar-nav .nav-link {
            color: var(--text-light) !important;
            font-weight: 500;
            position: relative;
            padding: 8px 15px;
        }
        
        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover:after {
            width: 70%;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 30 30'%3E%3Cpath d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            width: 28px;
            height: 28px;
        }
        
        /* Authentication Buttons */
        .auth-buttons .nav-link {
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            padding: 8px 20px;
            margin: 0 5px;
            z-index: 1;
        }
        
        .auth-buttons .nav-link:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            transition: all 0.3s;
            z-index: -1;
        }
        
        .auth-buttons .nav-link:hover:before {
            width: 100%;
        }
        
        .auth-buttons .btn-login {
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        .auth-buttons .btn-register {
            background-color: var(--accent-color);
            color: var(--text-dark) !important;
            border: 1px solid var(--accent-color);
        }
        
        .auth-buttons .btn-register:before {
            background: rgba(255, 255, 255, 0.3);
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--primary-color), #2C2416);
            color: var(--text-light);
            padding: 60px 0 30px;
        }
        
        .footer-heading {
            font-size: 1.5rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-heading:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background: var(--accent-color);
            bottom: 0;
            left: 0;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            margin-bottom: 12px;
            display: block;
            text-decoration: none;
        }
        
        .footer-link:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            margin-right: 10px;
            border-radius: 50%;
            line-height: 40px;
            text-align: center;
            color: var(--text-light);
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            background: rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-kemendikbud.png') }}" alt="Logo" class="logo-img">
                <span class="fw-bold">MUSEUM INDONESIA</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavNew" aria-controls="navbarNavNew" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavNew">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#about"><i class="fas fa-info-circle me-1"></i> Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#program"><i class="fas fa-lightbulb me-1"></i> Program Unggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#activities"><i class="fas fa-calendar-check me-1"></i> Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery"><i class="fas fa-images me-1"></i> Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact"><i class="fas fa-envelope me-1"></i> Kontak</a>
                    </li>
                </ul>
                <ul class="navbar-nav auth-buttons d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link btn-login" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-register" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Registrasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h3 class="footer-heading">Museum Indonesia</h3>
                    <p>Melestarikan dan memperkenalkan kekayaan warisan budaya Indonesia kepada masyarakat melalui museum yang informatif dan interaktif.</p>
                    <div class="social-links mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h3 class="footer-heading">Navigasi</h3>
                    <a href="#about" class="footer-link">Tentang Kami</a>
                    <a href="#program" class="footer-link">Program Unggulan</a>
                    <a href="#activities" class="footer-link">Kegiatan</a>
                    <a href="#gallery" class="footer-link">Galeri</a>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h3 class="footer-heading">Museum Populer</h3>
                    <a href="#" class="footer-link">Museum Nasional Indonesia</a>
                    <a href="#" class="footer-link">Museum Fatahillah</a>
                    <a href="#" class="footer-link">Museum Wayang</a>
                    <a href="#" class="footer-link">Museum Satria Mandala</a>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h3 class="footer-heading">Kontak Kami</h3>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Jenderal Sudirman No. 123, Jakarta</p>
                    <p><i class="fas fa-phone me-2"></i> (021) 1234-5678</p>
                    <p><i class="fas fa-envelope me-2"></i> info@museumindonesia.id</p>
                </div>
            </div>
            
            <div class="text-center copyright">
                <p class="mb-0">&copy; {{ date('Y') }} Museum Indonesia. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - navbarHeight;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>