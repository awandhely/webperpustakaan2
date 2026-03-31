<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-shield-alt"></i> Petugas Panel</h3>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('petugas.dashboard') }}" class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

        <div class="menu-divider"></div>
        <div class="menu-label">Manajemen</div>

        <li>
            <a href="{{ route('petugas.users.index') }}" class="{{ request()->routeIs('petugas.users*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Anggota
            </a>
        </li>
        <li>
            <a href="{{ route('petugas.books.index') }}" class="{{ request()->routeIs('petugas.books*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Daftar Buku
            </a>
        </li>
        <li>
            <a href="{{ route('petugas.categories.index') }}" class="{{ request()->routeIs('petugas.categories*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Kategori
            </a>
        </li>

        <div class="menu-divider"></div>
        <div class="menu-label">Transaksi</div>

        <li>
            <a href="{{ route('petugas.borrowings.index') }}" class="{{ request()->routeIs('petugas.borrowings*') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i> Peminjaman
            </a>
        </li>

        <div class="menu-divider"></div>
        <div class="menu-label">Laporan</div>
        <li>
            <a href="{{ route('petugas.reports.index') }}" class="{{ request()->routeIs('petugas.reports*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i> Laporan
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ substr(auth()->user()->name ?? 'P', 0, 1) }}</div>
            <div class="user-details">
                <h4>{{ auth()->user()->name ?? 'Petugas' }}</h4>
                <p>Petugas Perpustakaan</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

</body>
</html>
