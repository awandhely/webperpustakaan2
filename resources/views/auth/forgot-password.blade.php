<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Perpustakaan Digital</title>
    
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

<div class="container">
    <div class="card">
        <div class="header">
            <div class="header-icon">🔑</div>
            <h1>Lupa Password?</h1>
            <p>Masukkan email Anda dan kami akan mengirimkan link untuk reset password.</p>
        </div>

        @if(session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Kirim Link Reset Password</button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">← Kembali ke login</a>
        </div>
    </div>

    <div class="back-home">
        <a href="/">← Kembali ke beranda</a>
    </div>
</div>

</body>
</html>
