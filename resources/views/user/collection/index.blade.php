<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Saya - Perpustakaan</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

<body>

@include('user.navbar')

<div class="main-container">
    <div class="header">
        <h2>Koleksi Saya</h2>
        <p>Buku-buku favorit yang Anda simpan</p>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if($collections->count() > 0)
    <div class="books-grid">
        @foreach($collections as $book)
        <div class="book-card">
            <div class="book-cover">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                @else
                    <i class="fas fa-book"></i>
                @endif
            </div>
            <div class="book-info">
                <span class="book-category">{{ $book->category->name ?? 'Umum' }}</span>
                <h3 class="book-title">{{ $book->title }}</h3>
                <p class="book-author">{{ $book->author }}</p>
                <div class="book-meta">
                    <a href="{{ route('user.books.show', $book) }}" class="btn-detail">Lihat Buku</a>
                    
                    <form action="{{ route('user.books.collection.toggle', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-remove" title="Hapus dari koleksi">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-bookmark"></i>
        <h3>Belum ada buku di koleksi</h3>
        <p style="margin-top: 10px;">Jelajahi <a href="{{ route('user.books.index') }}">Daftar Buku</a> dan simpan buku favorit Anda!</p>
    </div>
    @endif
</div>

</body>
</html>
