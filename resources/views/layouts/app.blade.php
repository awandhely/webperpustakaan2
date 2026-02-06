<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">
    {{-- SIDEBAR --}}
    @include('components.sidebar')

    {{-- CONTENT --}}
    <div class="content">
        <div class="topbar">
            <span>Halo, {{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout">Logout</button>
            </form>
        </div>

        <div class="page">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
