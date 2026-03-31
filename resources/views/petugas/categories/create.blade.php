<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <a href="{{ route('petugas.categories.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
    <h1 style="margin-bottom:28px;">Tambah Kategori</h1>

    <div class="form-card">
        <form action="{{ route('petugas.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Kategori *</label>
                <input type="text" name="name" required>
            </div>
            <button type="submit" class="btn-primary">Simpan Kategori</button>
        </form>
    </div>
</div>

</body>
</html>
