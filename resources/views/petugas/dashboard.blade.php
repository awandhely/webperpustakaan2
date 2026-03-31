<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - Perpustakaan</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-content">
    <div class="page-header">
        <h1>Dashboard Petugas</h1>
    </div>
    
    <div class="welcome-card">
        <h2>Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
        <p>Ayo kelola data perpustakaan hari ini.</p>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Buku</div>
                    <div class="stat-value">{{ \App\Models\Book::count() }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-book"></i></div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Buku Dipinjam</div>
                    <div class="stat-value">{{ \App\Models\Borrowing::where('status', 'dipinjam')->count() }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-book-open"></i></div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Menunggu Persetujuan</div>
                    <div class="stat-value">{{ \App\Models\Borrowing::where('status', 'menunggu')->count() }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Anggota</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'user')->count() }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
