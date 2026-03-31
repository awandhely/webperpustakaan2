<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Daftar Buku</h2>
        <a href="{{ route('admin.books.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        @if($books->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>
                        <div class="book-info">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" class="book-cover" alt="">
                            @else
                                <div class="book-cover" style="display:flex;align-items:center;justify-content:center;color:#9ca3af;">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                            <div>
                                <div class="book-title">{{ $book->title }}</div>
                                <div class="book-author">{{ $book->author }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="category-badge">{{ $book->category->name ?? '-' }}</span>
                    </td>
                    <td>{{ $book->publisher ?? '-' }}</td>
                    <td>{{ $book->year ?? '-' }}</td>
                    <td>
                        <span class="stock-badge {{ $book->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                            {{ $book->stock }} eksemplar
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.books.show', $book) }}" class="btn btn-detail">Detail</a>
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <i class="fas fa-book"></i>
            <p>Belum ada buku</p>
        </div>
        @endif
    </div>
</div>

</body>
</html>