<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <a href="{{ route('admin.users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <h1 class="page-title">Edit Pengguna</h1>

    <div class="form-card">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Lengkap *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat *</label>
                <textarea id="alamat" name="alamat" required style="width: 100%; padding: 14px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 15px; font-family: inherit; min-height: 100px;">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password">
                    <div class="hint">Kosongkan jika tidak ingin mengubah password</div>
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" value="{{ $user->role == 'admin' ? 'Admin' : ($user->role == 'petugas' ? 'Petugas' : 'Anggota') }}" readonly style="background-color: #f3f4f6; color: #6b7280; cursor: not-allowed;">
                <input type="hidden" name="role" value="{{ $user->role }}">
                @error('role') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>