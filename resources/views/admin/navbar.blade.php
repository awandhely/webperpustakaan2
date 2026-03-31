

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
