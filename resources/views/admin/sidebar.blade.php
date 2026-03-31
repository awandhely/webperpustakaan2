<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-shield-alt"></i> Admin Panel</h3>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

        <div class="menu-divider"></div>
        <div class="menu-label">Manajemen</div>
                <li>
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="{{ request()->get('role') == 'admin' ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i> Data Admin
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.users.index', ['role' => 'petugas']) }}" class="{{ request()->get('role') == 'petugas' ? 'active' : '' }}">
                        <i class="fas fa-user-shield"></i> Data Petugas
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index', ['role' => 'user']) }}" class="{{ request()->get('role') == 'user' ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Data Anggota
                    </a>
                </li>
        <li>
            <a href="/admin/books" class="{{ request()->is('admin/books*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Daftar Buku
            </a>
        </li>
        <li>
            <a href="/admin/categories" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Kategori
            </a>
        </li>

        <div class="menu-divider"></div>
        <div class="menu-label">Transaksi</div>

        <li>
            <a href="/admin/borrowings" class="{{ request()->is('admin/borrowings*') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i> Peminjaman
            </a>
        </li>
        <li>
            <a href="{{ route('admin.ratings.index') }}" class="{{ request()->is('admin/ratings*') ? 'active' : '' }}">
                <i class="fas fa-star"></i> History Ulasan
            </a>
        </li>

        <div class="menu-divider"></div>
        <div class="menu-label">Laporan</div>
        <li>
            <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i> Laporan
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
            <div class="user-details">
                <h4>{{ auth()->user()->name ?? 'Admin' }}</h4>
                <p>Administrator</p>
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
