<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Ulasan - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Riwayat Ulasan</h2>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        @if($ratings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ratings as $rating)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">{{ substr($rating->user->name, 0, 1) }}</div>
                            <span>{{ $rating->user->name }}</span>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.books.show', $rating->book_id) }}" class="book-link">
                            {{ $rating->book->title }}
                        </a>
                    </td>
                    <td>
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                    </td>
                    <td>
                        <div class="review-text" title="{{ $rating->review }}">
                            {{ $rating->review ?: '-' }}
                        </div>
                    </td>
                    <td>{{ $rating->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.ratings.destroy', $rating) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="pagination-wrapper">
            {{ $ratings->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-star"></i>
            <p>Belum ada ulasan</p>
        </div>
        @endif
    </div>
</div>

</body>
</html>
