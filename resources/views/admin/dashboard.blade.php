<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #2c3e50;
            line-height: 1.6;
        }
        
        .main-content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        /* Header Section */
        .page-header {
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 8px;
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 14px;
        }
        
        .breadcrumb i {
            font-size: 12px;
        }
        
        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 32px;
            border-radius: 16px;
            color: white;
            margin-bottom: 32px;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.15);
        }
        
        .welcome-card h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .welcome-card p {
            font-size: 15px;
            opacity: 0.9;
        }
        
        .welcome-card .date-time {
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 14px;
            opacity: 0.85;
        }
        
        .welcome-card .date-time i {
            margin-right: 6px;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        
        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--card-color, #667eea);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            background: var(--card-color, #667eea);
        }
        
        .stat-label {
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
        }
        
        .stat-change {
            font-size: 13px;
            color: #10b981;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .stat-change.negative {
            color: #ef4444;
        }
        
        .stat-change i {
            font-size: 11px;
        }
        
        /* Quick Stats Section */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }
        
        .quick-stat-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .quick-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-size: 18px;
        }
        
        .quick-stat-info h4 {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .quick-stat-info p {
            font-size: 20px;
            font-weight: 600;
            color: #1a202c;
        }
        
        /* Activity Section */
        .activity-section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .section-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1a202c;
        }
        
        .view-all {
            color: #667eea;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .view-all:hover {
            color: #764ba2;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 24px;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .page-header h1 {
                font-size: 24px;
            }
            
            .welcome-card {
                padding: 24px;
            }
            
            .welcome-card h2 {
                font-size: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }
            
            .quick-stats {
                grid-template-columns: 1fr;
            }
            
            .welcome-card .date-time {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>
<body>

@include('admin.sidebar')

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>Dashboard</h1>
        <div class="breadcrumb">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </div>
    </div>
    
    <!-- Welcome Card -->
    <div class="welcome-card">
        <h2>Selamat Datang Kembali, {{ auth()->user()->name }}! 👋</h2>
        <p>Kelola sistem perpustakaan dengan mudah dan efisien</p>
        <div class="date-time">
            <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
            <span><i class="far fa-clock"></i> <span id="current-time"></span></span>
        </div>
    </div>
    
    <!-- Main Stats -->
    <div class="stats-grid">
        <div class="stat-card" style="--card-color: #667eea;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-value">{{ \App\Models\User::count() }}</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-up"></i>
                        <span>8.5% dari bulan lalu</span>
                    </div>
                </div>
                <div class="stat-icon" style="background: #667eea;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="--card-color: #10b981;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Admin Aktif</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-up"></i>
                        <span>2 baru minggu ini</span>
                    </div>
                </div>
                <div class="stat-icon" style="background: #10b981;">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="--card-color: #f59e0b;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Petugas</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'petugas')->count() }}</div>
                    <div class="stat-change">
                        <i class="fas fa-minus"></i>
                        <span>Stabil</span>
                    </div>
                </div>
                <div class="stat-icon" style="background: #f59e0b;">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="--card-color: #ef4444;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Anggota</div>
                    <div class="stat-value">{{ \App\Models\User::where('role', 'anggota')->count() }}</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-up"></i>
                        <span>12% dari bulan lalu</span>
                    </div>
                </div>
                <div class="stat-icon" style="background: #ef4444;">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="quick-stats">
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Total Buku</h4>
                <p>1,248</p>
            </div>
        </div>
        
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Buku Dipinjam</h4>
                <p>342</p>
            </div>
        </div>
        
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Tersedia</h4>
                <p>906</p>
            </div>
        </div>
        
        <div class="quick-stat-item">
            <div class="quick-stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="quick-stat-info">
                <h4>Terlambat</h4>
                <p>23</p>
            </div>
        </div>
    </div>
    
    <!-- Activity Section -->
    <div class="activity-section">
        <div class="section-header">
            <h3>Aktivitas Terbaru</h3>
            <a href="#" class="view-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <p style="color: #64748b; text-align: center; padding: 40px 0;">Tidak ada aktivitas terbaru untuk ditampilkan</p>
    </div>
</div>

<script>
    // Update current time
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