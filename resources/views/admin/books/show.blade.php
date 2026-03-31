<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <a href="{{ route('admin.books.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Buku
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h1>{{ $book->title }}</h1>
            <p>{{ $book->author }}</p>
        </div>

        <div class="detail-body">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" class="book-cover-large" alt="">
            @else
                <div class="book-cover-large" style="display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:48px;">
                    <i class="fas fa-book"></i>
                </div>
            @endif

            <div class="info-grid">
                <div class="info-item">
                    <label>Kategori</label>
                    <p>{{ $book->category->name ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <label>ISBN</label>
                    <p>{{ $book->isbn ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <label>Penerbit</label>
                    <p>{{ $book->publisher ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <label>Tahun Terbit</label>
                    <p>{{ $book->year ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <label>Stok</label>
                    <span class="stock-badge {{ $book->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                        {{ $book->stock }} eksemplar
                    </span>
                </div>
            </div>

            @if($book->description)
            <div class="description-section">
                <h3>Deskripsi</h3>
                <p>{{ $book->description }}</p>
            </div>
            @endif

            <div class="actions">
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Buku
                </a>
                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
