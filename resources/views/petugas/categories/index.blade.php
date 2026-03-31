<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Kategori Buku</h2>
        <a href="{{ route('petugas.categories.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah Kategori</a>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-weight:600;color:#1f2937;">{{ $category->name }}</td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('petugas.categories.edit', $category) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('petugas.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="padding:40px;text-align:center;color:#6b7280;">Belum ada kategori</div>
        @endif
    </div>
</div>

</body>
</html>
