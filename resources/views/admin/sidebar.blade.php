<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f4f6f8;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            background: #111827;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid #1f2937;
        }

        .sidebar-header {
            padding: 18px 20px;
            border-bottom: 1px solid #1f2937;
        }

        .sidebar-header h3 {
            color: #f9fafb;
            font-size: 16px;
            margin: 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 10px 0;
            margin: 0;
        }

        .sidebar-menu li a,
        .sidebar-menu li button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            color: #9ca3af;
            text-decoration: none;
            background: none;
            border: none;
            text-align: left;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li button:hover {
            background: #1f2937;
            color: #f9fafb;
        }

        .sidebar-menu li a.active {
            background: #1f2937;
            color: #f9fafb;
            font-weight: 500;
        }

        /* ===== NAVBAR (TIPIS) ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            height: 48px; /* DIPERKECIL */
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            z-index: 100;
        }

        .navbar-title {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-user span {
            font-size: 13px;
            color: #374151;
        }

        .logout-btn {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            background: #ef4444;
            color: white;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-left: 240px;
            padding: 20px;
            padding-top: 64px; /* navbar 48px + jarak */
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .navbar {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li>
            <a href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">Management User</a>
        </li>
        <li>
            <a href="/admin/books" class="{{ request()->is('admin/books*') ? 'active' : '' }}">Daftar Buku</a>
        </li>
        <li>
            <a href="/admin/categories" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">Kategori Buku</a>
        </li>
        <li>
            <a href="/admin/borrowings" class="{{ request()->is('admin/borrowings*') ? 'active' : '' }}">Peminjaman</a>
        </li>
    </ul>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <div class="navbar-title">
        {{ $title ?? '' }}
    </div>

    <div class="navbar-user">
        <span>{{ auth()->user()->name ?? 'User' }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
