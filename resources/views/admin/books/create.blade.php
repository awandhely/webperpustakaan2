<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru</title>
    <style>
        :root {
            --sidebar-width: 260px;   /* Sesuaikan dengan lebar sidebar kamu */
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --success: #10b981;
            --danger: #dc2626;
            --gray: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: var(--sidebar-width);
            padding-right: 24px;
            padding-top: 32px;
            padding-bottom: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h2 {
            font-size: 28px;
            font-weight: 600;
            color: #1a202c;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-back:hover {
            background: #d1d5db;
        }

        .btn-save {
            background: var(--primary);
            color: white;
        }

        .btn-save:hover {
            background: var(--primary-dark);
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success);
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger);
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 32px;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
            outline: none;
        }

        .is-invalid {
            border-color: var(--danger);
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 14px;
            margin-top: 4px;
        }

        .required::after {
            content: " *";
            color: var(--danger);
        }

        @media (max-width: 992px) {
            :root {
                --sidebar-width: 0;
            }
            .container {
                padding-left: 16px;
                padding-right: 16px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="container">
        <div class="header">
            <h2>📚 Tambah Buku Baru</h2>
            <a href="{{ route('admin.books.index') }}" class="btn btn-back">← Kembali ke Daftar</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                Ada kesalahan dalam input:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label required">Judul Buku</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" required autofocus>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="author" class="form-label required">Penulis</label>
                    <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror"
                           value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" name="publisher" id="publisher" class="form-control"
                           value="{{ old('publisher') }}">
                </div>

                <div class="mb-4">
                    <label for="year" class="form-label">Tahun Terbit</label>
                    <input type="number" name="year" id="year" class="form-control"
                           value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}">
                </div>

                <div class="mb-4">
                    <label for="stock" class="form-label required">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock', 1) }}" min="0" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Cover Buku (opsional)</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/gif">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Maksimal 2MB, format JPG/PNG/GIF</small>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-save btn-lg">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>