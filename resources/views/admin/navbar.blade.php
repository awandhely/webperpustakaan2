<style>
    .navbar {
        height: 64px;
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        position: fixed;
        top: 0;
        left: 240px; /* sejajar sidebar */
        right: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        z-index: 100;
    }

    .navbar-title {
        font-size: 18px;
        font-weight: 600;
        color: #111827;
    }

    .navbar-user {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .navbar-user span {
        font-size: 14px;
        color: #374151;
    }

    .navbar-user small {
        display: block;
        font-size: 12px;
        color: #6b7280;
    }

    .logout-btn {
        background: #ef4444;
        border: none;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.2s;
    }

    .logout-btn:hover {
        background: #dc2626;
    }

    @media (max-width: 768px) {
        .navbar {
            left: 0;
        }
    }
</style>

<div class="navbar">
    <div class="navbar-title">
        Dashboard
    </div>

    <div class="navbar-user">
        <div>
            <span>{{ auth()->user()->name }}</span>
            <small>{{ auth()->user()->role }}</small>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </div>
</div>
