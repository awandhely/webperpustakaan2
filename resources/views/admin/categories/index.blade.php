<!DOCTYPE html>
<html>
<head>
    <title>Kategori Buku</title>
    <style>
        body { margin:0; font-family:sans-serif; background:#f4f6f8; }
        .content { margin-left:260px; padding:30px; }
        .card { background:#fff; padding:20px; border-radius:12px; }
        table { width:100%; border-collapse:collapse; margin-top:15px; }
        th,td { padding:12px; border-bottom:1px solid #eee; }
        a, button { padding:8px 12px; border-radius:6px; text-decoration:none; border:none; cursor:pointer; }
        .btn { background:#111827; color:#fff; }
        .btn-danger { background:#dc2626; color:#fff; }
    </style>
</head>
<body>

@include('admin.sidebar')

<div class="content">
    <h2>📚 Kategori Buku</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="btn">➕ Tambah Kategori</a>

    <div class="card">
        <table>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>

            @foreach($categories as $cat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cat->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn">✏️ Edit</a>

                    <form method="POST"
                          action="{{ route('admin.categories.destroy', $cat->id) }}"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger"
                                onclick="return confirm('Hapus kategori?')">
                            🗑️
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
