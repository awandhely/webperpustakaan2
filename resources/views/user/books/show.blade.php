<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Perpustakaan</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('user.navbar')

<div class="main-container">
    <a href="{{ route('user.books.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Buku
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="book-detail">
        <div class="book-header">
            <div class="book-cover">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                @else
                    <i class="fas fa-book"></i>
                @endif
            </div>
            <div class="book-header-info">
                <h1>{{ $book->title }}</h1>
                <p class="author">oleh {{ $book->author }}</p>
                <div style="margin-bottom: 15px; color: #fbbf24;">
                    @php
                        $avgRating = $book->ratings()->avg('rating');
                        $ratingCount = $book->ratings()->count();
                    @endphp
                    @if($ratingCount > 0)
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= round($avgRating) ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                        <span style="color: white; font-size: 14px; margin-left: 8px;">({{ number_format($avgRating, 1) }}/5 dari {{ $ratingCount }} ulasan)</span>
                    @else
                        <span style="color: white; font-size: 14px; opacity: 0.8;">Belum ada rating</span>
                    @endif
                </div>
                <div class="book-badges">
                    <span class="badge">{{ $book->category->name ?? 'Umum' }}</span>
                    @if($book->year)
                        <span class="badge">{{ $book->year }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="book-body">
            <div class="info-grid">
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
                    <label>Kategori</label>
                    <p>{{ $book->category->name ?? '-' }}</p>
                </div>
            </div>

            @if($book->description)
            <div class="description">
                <h3>Sinopsis</h3>
                <p>{{ $book->description }}</p>
            </div>
            @endif

            <div class="stock-info">
                <i class="fas fa-boxes-stacked"></i>
                <div class="stock-text">
                    <h4>Stok Tersedia</h4>
                    <p>{{ $book->stock }} eksemplar</p>
                </div>
            </div>

            <div class="borrow-form">
                <div style="display: flex; gap: 12px;">
                    @if($book->stock > 0)
                        <button type="button" onclick="openBorrowModal()" class="btn-borrow" style="flex: 2;">
                            <i class="fas fa-hand-holding"></i> Pinjam Buku Ini
                        </button>
                    @else
                        <button class="btn-borrow" disabled style="flex: 2;">
                            <i class="fas fa-times-circle"></i> Stok Habis
                        </button>
                    @endif

                    @php
                        $inCollection = Auth::user()->collections()->where('book_id', $book->id)->exists();
                    @endphp

                    <form action="{{ route('user.books.collection.toggle', $book) }}" method="POST" style="flex: 1;">
                        @csrf
                        <button type="submit" class="btn-borrow" style="background: {{ $inCollection ? '#6b7280' : 'linear-gradient(135deg, #fb923c, #f97316)' }};">
                            <i class="fas fa-{{ $inCollection ? 'bookmark' : 'plus-circle' }}"></i> 
                            {{ $inCollection ? 'Koleksi' : 'Koleksi' }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="reviews-section">
                <h3><i class="fas fa-star" style="color: #f59e0b;"></i> Ulasan Pembaca</h3>
                
                @php
                    $ratings = $book->ratings()->with('user')->latest()->get();
                @endphp

                @if($ratings->count() > 0)
                    @foreach($ratings as $rating)
                        <div class="review-item">
                            <div class="review-header">
                                <span class="reviewer-name">{{ $rating->user->name }}</span>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="review-text">{{ $rating->review ?: 'Tidak ada ulasan tertulis.' }}</p>
                            <div class="review-date">
                                {{ $rating->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="no-reviews">
                        <i class="fas fa-comment-slash" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                        Belum ada ulasan untuk buku ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Borrow Modal --}}
<div id="borrowModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Ajukan Peminjaman</h3>
            <span class="close-modal" onclick="closeBorrowModal()">&times;</span>
        </div>
        <form action="{{ route('user.books.borrow', $book) }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="borrow_date">Tanggal Meminjam</label>
                <input type="date" id="borrow_date" name="borrow_date" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="return_date">Tanggal Pengembalian (Estimasi)</label>
                <input type="date" id="return_date" name="return_date" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                <small style="color: #6b7280; font-size: 12px; margin-top: 4px; display: block;">Maksimal peminjaman 7 hari secara default.</small>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Kirim Permintaan
            </button>
        </form>
    </div>
</div>

<script>
    function openBorrowModal() {
        document.getElementById('borrowModal').style.display = 'flex';
    }

    function closeBorrowModal() {
        document.getElementById('borrowModal').style.display = 'none';
    }

    // Close on click outside
    window.onclick = function(event) {
        const modal = document.getElementById('borrowModal');
        if (event.target == modal) {
            closeBorrowModal();
        }
    }
</script>

</body>
</html>
