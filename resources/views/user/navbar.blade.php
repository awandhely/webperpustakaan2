<nav class="user-navbar">
    <div class="nav-container">
        <a href="{{ route('user.dashboard') }}" class="nav-logo">
            <i class="fas fa-book-open"></i>
            <span>Perpustakaan</span>
        </a>

        <ul class="nav-menu">
            <li>
                <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li>
                <a href="{{ route('user.books.index') }}" class="{{ request()->routeIs('user.books.*') && !request()->routeIs('user.books.collection.index') ? 'active' : '' }}">
                    <i class="fas fa-book"></i> Daftar Buku
                </a>
            </li>
            <li>
                <a href="{{ route('user.borrowings.history') }}" class="{{ request()->routeIs('user.borrowings.history') ? 'active' : '' }}">
                    <i class="fas fa-history"></i> History
                </a>
            </li>
            <li>
                <a href="{{ route('user.collection.index') }}" class="{{ request()->routeIs('user.collection.index') ? 'active' : '' }}">
                    <i class="fas fa-bookmark"></i> Koleksi
                </a>
            </li>
        </ul>

        <div class="nav-user">
            <div class="user-profile">
                <div class="user-avatar">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</div>
                <span class="user-name">{{ auth()->user()->name ?? 'User' }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>

        <button class="mobile-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>


