<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <a href="{{ route('admin.users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <h1 class="page-title">Tambah Pengguna</h1>

    <div class="form-card">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat *</label>
                <textarea id="alamat" name="alamat" required style="width: 100%; padding: 14px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 15px; font-family: inherit; min-height: 100px;">{{ old('alamat') }}</textarea>
                @error('alamat') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" value="{{ $role == 'petugas' ? 'Petugas' : ($role == 'user' ? 'Anggota' : ($role == 'admin' ? 'Admin' : 'User')) }}" readonly style="background-color: #f3f4f6; color: #6b7280; cursor: not-allowed;">
                <input type="hidden" name="role" value="{{ $role ?? 'user' }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>