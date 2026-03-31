<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ auth()->user()->name }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('user.navbar')

@php
    use App\Models\Borrowing;

    $userId = auth()->id();
    $total    = Borrowing::where('user_id', $userId)->count();
    $menunggu = Borrowing::where('user_id', $userId)->where('status', 'menunggu')->count();
    $dipinjam = Borrowing::where('user_id', $userId)->where('status', 'dipinjam')->count();
    $riwayat  = Borrowing::where('user_id', $userId)->where('status', 'dikembalikan')->count();

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
            <div class="stat-icon"><i class="fas fa-chart-bar"></i></div>
            <div class="stat-title">Total Peminjaman</div>
            <div class="stat-value">{{ $total }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-title">Menunggu Konfirmasi</div>
            <div class="stat-value">{{ $menunggu }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-book-open"></i></div>
            <div class="stat-title">Sedang Dipinjam</div>
            <div class="stat-value">{{ $dipinjam }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-title">Riwayat Pengembalian</div>
            <div class="stat-value">{{ $riwayat }}</div>
        </div>
    </div>
</div>

</body>
</html>