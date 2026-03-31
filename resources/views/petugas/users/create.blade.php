<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <a href="{{ route('petugas.users.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
    <h1 style="margin-bottom:28px;">Tambah Anggota</h1>

    <div class="form-card">
        <form action="{{ route('petugas.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Alamat *</label>
                <textarea name="alamat" required></textarea>
            </div>
            <div class="form-group">
                <label>Password *</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Simpan Anggota</button>
        </form>
    </div>
</div>

</body>
</html>
