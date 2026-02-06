<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>

    <style>
        * { box-sizing: border-box; }

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

        .sidebar-menu a {
            display: block;
            padding: 10px 20px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #1f2937;
            color: #f9fafb;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            height: 44px; /* LEBIH TIPIS */
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 14px;
            z-index: 100;
        }

        .navbar-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logout-btn {
            background: #ef4444;
            border: none;
            color: white;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-left: 240px;
            padding: 20px;
            padding-top: 64px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>User</h3>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="/user/dashboard" class="{{ request()->is('user/dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="/user/books" class="{{ request()->is('user/books*') ? 'active' : '' }}">
                Daftar Buku
            </a>
        </li>
    </ul>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <div class="navbar-title">
        {{ $title ?? '' }}
    </div>

    <div class="navbar-actions">
        <span style="font-size:12px; color:#374151;">
            {{ auth()->user()->name ?? 'User' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
