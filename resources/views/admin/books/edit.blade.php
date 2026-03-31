<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <a href="{{ route('admin.books.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <h1 class="page-title">Edit Buku</h1>

    <div class="form-card">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Buku *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
                @error('title') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="author">Penulis *</label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                @error('author') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">Kategori *</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="publisher">Penerbit</label>
                    <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
                </div>

                <div class="form-group">
                    <label for="year">Tahun Terbit</label>
                    <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="stock">Stok *</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" min="0" required>
                @error('stock') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Cover Buku</label>
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" class="current-cover" alt="">
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                @error('image') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>