<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Kategori Buku</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        @if($categories->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-weight:600;color:#1f2937;">{{ $category->name }}</td>
                    <td>{{ $category->books_count ?? $category->books->count() }} buku</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
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
            <i class="fas fa-tags" style="font-size:48px;color:#d1d5db;margin-bottom:16px;"></i>
            <p>Belum ada kategori</p>
        </div>
        @endif
    </div>
</div>

</body>
</html>
