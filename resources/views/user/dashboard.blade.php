<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard - {{ auth()->user()->name }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --success: #10b981;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0f2fe 100%);
            color: var(--gray-900);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            margin-left: 260px; /* sesuaikan lebar sidebar kamu */
            padding: 2.5rem 2rem;
            max-width: 1400px;
        }

        .greeting {
            margin-bottom: 2.5rem;
        }

        .greeting h2 {
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .greeting p {
            font-size: 1.1rem;
            color: var(--gray-600);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08),
                        0 4px 16px -6px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--gray-200);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.22);
            border-color: var(--primary-light);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            opacity: 0.85;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            font-size: 1.5rem;
        }

        .stat-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.75rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .container {
                margin-left: 0;
                padding: 1.5rem 1rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .stat-value {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>

@include('user.sidebar')

@php
    use App\Models\Borrowing;

    $userId = auth()->id();
    $total    = Borrowing::where('user_id', $userId)->count();
    $menunggu = Borrowing::where('user_id', $userId)->where('status', 'menunggu')->count();
    $dipinjam = Borrowing::where('user_id', $userId)->where('status', 'dipinjam')->count();
    $riwayat  = Borrowing::where('user_id', $userId)->where('status', 'dikembalikan')->count();

    // Greeting berdasarkan waktu (WIB)
    $hour = now()->setTimezone('Asia/Jakarta')->hour;
    $greeting = match(true) {
        $hour < 11 => 'Selamat Pagi',
        $hour < 15 => 'Selamat Siang',
        $hour < 18 => 'Selamat Sore',
        default    => 'Selamat Malam',
    };
@endphp

<div class="container">
    <div class="greeting">
        <h2>{{ $greeting }}, {{ auth()->user()->name }} 👋</h2>
        <p>Selamat datang kembali di dashboard peminjaman buku kamu</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-title">Total Peminjaman</div>
            <div class="stat-value">{{ $total }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">⏳</div>
            <div class="stat-title">Menunggu Konfirmasi</div>
            <div class="stat-value" style="color: var(--warning);">{{ $menunggu }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">📖</div>
            <div class="stat-title">Sedang Dipinjam</div>
            <div class="stat-value" style="color: var(--success);">{{ $dipinjam }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1);">🔄</div>
            <div class="stat-title">Riwayat Pengembalian</div>
            <div class="stat-value">{{ $riwayat }}</div>
        </div>
    </div>
</div>

</body>
</html>