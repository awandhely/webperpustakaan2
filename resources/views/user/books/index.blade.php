<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('user.navbar')

<div class="main-container">
    <div class="header">
        <h2>Daftar Buku</h2>
        <p>Temukan dan pinjam buku yang Anda inginkan</p>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari judul buku atau penulis..." onkeyup="filterBooks()">
    </div>

    @if($books->count() > 0)
    <div class="books-grid" id="booksGrid">
        @foreach($books as $book)
        <div class="book-card" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}">
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
                    <span class="stock-badge {{ $book->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                        {{ $book->stock > 0 ? 'Tersedia: ' . $book->stock : 'Habis' }}
                    </span>
                    <a href="{{ route('user.books.show', $book) }}" class="btn-detail">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-book-open"></i>
        <p>Belum ada buku tersedia</p>
    </div>
    @endif
</div>

<script>
function filterBooks() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.book-card');
    
    cards.forEach(card => {
        const title = card.dataset.title;
        const author = card.dataset.author;
        if (title.includes(query) || author.includes(query)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

</body>
</html>