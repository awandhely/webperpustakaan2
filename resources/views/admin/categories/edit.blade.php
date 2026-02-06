<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
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
    <h2>✏️ Edit Kategori</h2>

    <div class="card">
        <form method="POST"
              action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <input type="text"
                   name="name"
                   value="{{ $category->name }}"
                   required>

            <button type="submit">Update</button>
        </form>
    </div>
</div>

</body>
</html>
