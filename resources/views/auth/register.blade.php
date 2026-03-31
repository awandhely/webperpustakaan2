<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | E-Pusda</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Bergabunglah</h1>
                <p>Buat akun Anda dan mulai menjelajahi dunia melalui buku.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-grid">
                    <div class="form-group-full">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama lengkap" value="{{ old('name') }}" required autofocus>
                            <i class="fas fa-user"></i>
                        </div>
                        @error('name')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-full">
                        <label for="email">Alamat Email</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                            <i class="fas fa-envelope"></i>
                        </div>
                        @error('email')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-full">
                        <label for="alamat">Alamat Lengkap</label>
                        <div class="input-wrapper">
                            <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Anda..." rows="2" required>{{ old('alamat') }}</textarea>
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        @error('alamat')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Min. 8 kar." required>
                            <i class="fas fa-lock"></i>
                        </div>
                        @error('password')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi</label>
                        <div class="input-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi" required>
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        Daftar Sekarang <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </div>
            </form>

            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>

        <div class="back-home">
            <a href="/">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
