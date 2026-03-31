<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <a href="{{ route('petugas.users.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
    <h1 style="margin-bottom:28px;">Edit Anggota</h1>

    <div class="form-card">
        <form action="{{ route('petugas.users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label>Alamat *</label>
                <textarea name="alamat" required>{{ $user->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label>Role *</label>
                <select name="role" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password">
            </div>
            <button type="submit" class="btn-primary">Update Anggota</button>
        </form>
    </div>
</div>

</body>
</html>
