<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <a href="{{ route('petugas.books.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
    <h1 style="margin-bottom:28px;">Tambah Buku Baru</h1>

    <div class="form-card">
        <form action="{{ route('petugas.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Judul Buku *</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Penulis *</label>
                <input type="text" name="author" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Kategori *</label>
                    <select name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="year">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="publisher">
                </div>
                <div class="form-group">
                    <label>Stok *</label>
                    <input type="number" name="stock" value="0" required>
                </div>
            </div>
            <div class="form-group">
                <label>Cover</label>
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn-primary">Simpan Buku</button>
        </form>
    </div>
</div>

</body>
</html>
