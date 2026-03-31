<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pusda | Perpustakaan Digital Masa Depan</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

    <nav id="navbar">
        <a href="/" class="logo">
            <i class="fas fa-book-reader"></i>
            E-Pusda
        </a>
        <ul class="nav-links">
            <li><a href="#features">Fitur</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="{{ route('login') }}" class="btn-nav-login">Masuk</a></li>
            <li><a href="{{ route('register') }}" class="btn-nav-register">Daftar</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-tag">🚀 Masa Depan Literasi Digital</div>
            <h1>Buka Jendela Dunia dengan <span>E-Pusda</span></h1>
            <p>Platform manajemen perpustakaan modern yang memadukan kenyamanan membaca digital dengan efisiensi pengelolaan data. Solusi cerdas untuk institusi pendidikan masa kini.</p>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="btn-primary">
                    Mulai Sekarang <i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('login') }}" class="btn-outline">
                    Akses Dashboard <i class="fas fa-laptop-code"></i>
                </a>
            </div>
        </div>

        <div class="hero-image">
            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" style="width: 100%">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#f97316;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#ea580c;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <circle cx="250" cy="250" r="200" fill="url(#grad1)" opacity="0.1"/>
                <rect x="150" y="100" width="200" height="300" rx="20" fill="var(--white)" stroke="var(--primary)" stroke-width="4"/>
                <line x1="180" y1="150" x2="320" y2="150" stroke="var(--gray-200)" stroke-width="8" stroke-linecap="round"/>
                <line x1="180" y1="180" x2="280" y2="180" stroke="var(--gray-200)" stroke-width="8" stroke-linecap="round"/>
                <line x1="180" y1="230" x2="320" y2="230" stroke="var(--gray-200)" stroke-width="8" stroke-linecap="round"/>
                <line x1="180" y1="260" x2="320" y2="260" stroke="var(--gray-200)" stroke-width="8" stroke-linecap="round"/>
                <line x1="180" y1="290" x2="250" y2="290" stroke="var(--gray-200)" stroke-width="8" stroke-linecap="round"/>
                <circle cx="250" cy="360" r="15" fill="var(--primary)"/>
            </svg>
            
            <div class="floating-card card-1">
                <div style="display:flex; gap:10px; align-items:center">
                    <div style="width:40px; height:40px; background:var(--primary-light); border-radius:10px; display:flex; align-items:center; justify-content:center; color:var(--primary)">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <div style="font-weight:700; font-size:14px">100% Digital</div>
                        <div style="font-size:12px; color:var(--gray-600)">Akses kapan saja</div>
                    </div>
                </div>
            </div>

            <div class="floating-card card-2">
                <div style="display:flex; gap:10px; align-items:center">
                    <div style="width:40px; height:40px; background:#dcfce7; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#166534">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div style="font-weight:700; font-size:14px">5000+ Pembaca</div>
                        <div style="font-size:12px; color:var(--gray-600)">Komunitas Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="section-header">
            <div class="hero-tag" style="margin-left:auto; margin-right:auto; display:table">Fitur Unggulan</div>
            <h2>Didesain Untuk Kemudahan Anda</h2>
            <p>Nikmati berbagai fitur mutakhir yang dirancang khusus untuk meningkatkan pengalaman literasi Anda secara efisien.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-box">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Pencarian Pintar</h3>
                <p>Temukan buku favorit Anda dalam hitungan detik dengan sistem pencarian berbasis kategori dan kata kunci yang akurat.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box">
                    <i class="fas fa-bookmark"></i>
                </div>
                <h3>Koleksi Pribadi</h3>
                <p>Simpan buku-buku impian Anda ke dalam daftar favorit dan akses kembali kapan pun Anda menginginkannya.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Monitoring Real-time</h3>
                <p>Pantau status peminjaman, tanggal pengembalian, dan histori bacaan Anda secara instan melalui dashboard personal.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Keamanan Data</h3>
                <p>Semua data pengguna dan koleksi buku terlindungi dengan enkripsi tingkat tinggi demi kenyamanan Anda beraktivitas.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Responsif & Ringan</h3>
                <p>Akses perpustakaan melalui perangkat apa pun—ponsel, tablet, atau komputer dengan tampilan yang selalu optimal.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Sistem Rating</h3>
                <p>Berikan ulasan dan rating pada buku yang telah Anda baca untuk membantu pembaca lain menemukan buku terbaik.</p>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stat-item">
            <h3>25k+</h3>
            <p>Total Buku</p>
        </div>
        <div class="stat-item">
            <h3>12k+</h3>
            <p>Pengguna Aktif</p>
        </div>
        <div class="stat-item">
            <h3>98%</h3>
            <p>Puas</p>
        </div>
        <div class="stat-item">
            <h3>15+</h3>
            <p>Kategori</p>
        </div>
    </section>

    <footer id="about">
        <div class="footer-grid">
            <div class="footer-info">
                <a href="/" class="logo" style="margin-bottom: 20px;">
                    <i class="fas fa-book-reader"></i>
                    E-Pusda
                </a>
                <p class="footer-desc">
                    E-Pusda adalah platform perpustakaan digital inovatif yang berkomitmen untuk mencerdaskan bangsa melalui akses literasi yang mudah dan modern.
                </p>
                <div style="display:flex; gap:15px; font-size:20px; color:var(--primary)">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-linkedin"></i>
                </div>
            </div>

            <div class="footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Koleksi Buku</a></li>
                    <li><a href="#">Peminjaman</a></li>
                    <li><a href="#">Bantuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Kontak</h4>
                <ul>
                    <li><a href="#"><i class="fas fa-envelope"></i> info@epusda.id</a></li>
                    <li><a href="#"><i class="fas fa-phone"></i> +62 812-3456-7890</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 E-Pusda. All rights reserved. | UKK LSP Junior Coder</p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>