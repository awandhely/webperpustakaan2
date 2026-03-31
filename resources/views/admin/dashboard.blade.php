<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-content">
    <div class="page-header">
        <h1>Dashboard</h1>
        <div class="breadcrumb">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </div>
    </div>
    
    <div class="welcome-card">
        <h2>Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
        <p>Kelola sistem perpustakaan dengan mudah dan efisien</p>
        <div class="date-time">
            <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
            <span><i class="far fa-clock"></i> <span id="current-time"></span></span>
        </div>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-value">{{ \App\Models\User::count() }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Admin Aktif</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Petugas</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'petugas')->count() }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Anggota</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'user')->count() }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="quick-stats">
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Total Buku</h4>
                <p>{{ \App\Models\Book::count() }}</p>
            </div>
        </div>
        
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Buku Dipinjam</h4>
                <p>{{ \App\Models\Borrowing::where('status', 'dipinjam')->count() }}</p>
            </div>
        </div>
        
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Tersedia</h4>
                <p>{{ \App\Models\Book::where('stock', '>', 0)->count() }}</p>
            </div>
        </div>
        
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Menunggu</h4>
                <p>{{ \App\Models\Borrowing::where('status', 'menunggu')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="activity-section">
        <div class="section-header">
            <h3>Aktivitas Terbaru</h3>
            <a href="#" class="view-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <p style="color: #6b7280; text-align: center; padding: 40px 0;">Tidak ada aktivitas terbaru</p>
    </div>
</div>

<script>
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
    }
    updateTime();
    setInterval(updateTime, 1000);
</script>

</body>
</html>