<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            color: #2d3748;
            line-height: 1.6;
        }

        header {
            background: white;
            padding: 25px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e8f5e9;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: 600;
            color: #2e7d32;
        }

        .logo i {
            font-size: 24px;
        }

        .nav {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .nav a {
            color: #2d3748;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .login {
            color: #2e7d32;
        }

        .login:hover {
            background: #f1f8f4;
        }

        .register {
            background: #2e7d32;
            color: white;
        }

        .register:hover {
            background: #1b5e20;
        }

        .hero {
            padding: 100px 20px;
            text-align: center;
            background: #f9fffe;
        }

        .hero-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .hero p {
            font-size: 18px;
            color: #546e7a;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 80px;
        }

        .cta a {
            padding: 14px 32px;
            font-size: 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .cta-login {
            border: 2px solid #2e7d32;
            color: #2e7d32;
            background: white;
        }

        .cta-login:hover {
            background: #f1f8f4;
        }

        .cta-register {
            background: #2e7d32;
            color: white;
            border: 2px solid #2e7d32;
        }

        .cta-register:hover {
            background: #1b5e20;
            border-color: #1b5e20;
        }

        .features {
            padding: 80px 20px;
            background: white;
        }

        .features-container {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
        }

        .feature-card {
            text-align: center;
            padding: 40px 30px;
            background: #f9fffe;
            border-radius: 8px;
            border: 1px solid #e8f5e9;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: #2e7d32;
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
            font-size: 32px;
        }

        .feature-card h3 {
            font-size: 20px;
            color: #1b5e20;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .feature-card p {
            color: #546e7a;
            font-size: 15px;
            line-height: 1.6;
        }

        .stats {
            padding: 80px 20px;
            background: #f9fffe;
            border-top: 1px solid #e8f5e9;
        }

        .stats-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 50px;
            text-align: center;
        }

        .stat-item h2 {
            font-size: 42px;
            color: #2e7d32;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-item p {
            font-size: 16px;
            color: #546e7a;
            font-weight: 500;
        }

        footer {
            background: #1b5e20;
            text-align: center;
            padding: 40px 20px;
            color: #e8f5e9;
        }

        footer p {
            margin-bottom: 6px;
            font-size: 14px;
        }

        .footer-brand {
            font-weight: 600;
            font-size: 16px;
            color: white;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            header {
                padding: 20px;
            }

            .logo {
                font-size: 18px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .cta {
                flex-direction: column;
                align-items: center;
            }

            .cta a {
                width: 100%;
                max-width: 280px;
            }

            .features-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <i class="fas fa-book"></i>
        <span>Perpustakaan Digital</span>
    </div>
    <div class="nav">
        <a href="/login" class="login">Login</a>
        <a href="/register" class="register">Register</a>
    </div>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>Perpustakaan Digital Modern</h1>
        <p>
            Sistem manajemen perpustakaan yang simple dan efisien untuk institusi pendidikan. 
            Kelola koleksi, peminjaman, dan laporan dalam satu platform.
        </p>

        <div class="cta">
            <a href="{{ route('login') }}" class="cta-login">Masuk</a>
            <a href="{{ route('register') }}" class="cta-register">Daftar Gratis</a>
        </div>
    </div>
</section>

<section class="features">
    <div class="features-container">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h3>Katalog Digital</h3>
            <p>Kelola dan organisir koleksi buku dengan sistem pencarian yang mudah dan cepat</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-sync-alt"></i>
            </div>
            <h3>Peminjaman Otomatis</h3>
            <p>Proses peminjaman dan pengembalian buku yang terotomatisasi dengan notifikasi</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <h3>Laporan Real-time</h3>
            <p>Dashboard analitik untuk monitoring aktivitas perpustakaan secara menyeluruh</p>
        </div>
    </div>
</section>

<section class="stats">
    <div class="stats-container">
        <div class="stat-item">
            <h2>10K+</h2>
            <p>Koleksi Buku</p>
        </div>
        <div class="stat-item">
            <h2>5K+</h2>
            <p>Pengguna Aktif</p>
        </div>
        <div class="stat-item">
            <h2>99%</h2>
            <p>Kepuasan</p>
        </div>
        <div class="stat-item">
            <h2>24/7</h2>
            <p>Akses Online</p>
        </div>
    </div>
</section>

<footer>
    <p class="footer-brand"><i class="fas fa-book"></i> Perpustakaan Digital</p>
    <p>© 2025 Perpustakaan Digital | UKK LSP Junior Coder</p>
    <p>Platform Manajemen Perpustakaan untuk Institusi Pendidikan</p>
</footer>

</body>
</html>