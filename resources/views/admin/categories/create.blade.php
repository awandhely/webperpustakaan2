<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <style>
        body { margin:0; font-family:sans-serif; background:#f4f6f8; }
        .content { margin-left:260px; padding:30px; }
        .card { background:#fff; padding:20px; border-radius:12px; max-width:400px; }
        input, button { width:100%; padding:10px; margin-top:10px; }
        button { background:#111827; color:#fff; border:none; }
    </style>
</head>
<body>

@include('admin.sidebar')

<div class="content">
    <h2>➕ Tambah Kategori</h2>

    <div class="card">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Nama kategori" required>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

</body>
</html>
