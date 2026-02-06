<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku - {{ $book->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
        }

        .container {
            margin-left: 260px;
            padding: 30px;
            max-width: 900px;
        }

        @media (max-width: 768px) {
            .container {
                margin-left: 0;
                padding: 20px;
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 24px;
            padding: 12px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: all 0.2s ease;
        }

        .back-link:hover {
            background: #f8fafc;
            transform: translateX(-4px);
        }

        .borrow-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            padding: 30px;
            color: white;
            display: flex;
            gap: 24px;
            align-items: center;
        }

        @media (max-width: 600px) {
            .card-header {
                flex-direction: column;
                text-align: center;
            }
        }

        .book-cover {
            width: 100px;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            flex-shrink: 0;
        }

        .book-cover-placeholder {
            width: 100px;
            height: 140px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            flex-shrink: 0;
        }

        .book-info h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .book-info p {
            opacity: 0.9;
            font-size: 16px;
        }

        .card-body {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group small {
            display: block;
            margin-top: 6px;
            color: #64748b;
            font-size: 13px;
        }

        .btn-group {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn {
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }

        .info-box p {
            color: #1e40af;
            font-size: 14px;
            margin: 0;
        }

        .info-box p strong {
            display: block;
            margin-bottom: 4px;
            font-size: 15px;
        }
    </style>
</head>
<body>

@include('user.sidebar')

<div class="container">
    <a href="{{ route('user.books.show', $book) }}" class="back-link">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Detail Buku
    </a>

    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    <div class="borrow-card">
        <div class="card-header">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-cover">
            @else
                <div class="book-cover-placeholder">📚</div>
            @endif
            <div class="book-info">
                <h1>{{ $book->title }}</h1>
                <p>✍️ {{ $book->author }}</p>
            </div>
        </div>

        <div class="card-body">
            <div class="info-box">
                <p>
                    <strong>📋 Informasi Peminjaman</strong>
                    Setelah mengajukan peminjaman, permintaan Anda akan diproses oleh petugas perpustakaan. 
                    Anda akan menerima notifikasi setelah permintaan disetujui.
                </p>
            </div>

            <form action="{{ route('user.books.borrow', $book) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="quantity">Jumlah yang Dipinjam</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="{{ $book->stock }}" value="1" required>
                    <small>Stok tersedia: {{ $book->stock }} eksemplar</small>
                </div>

                <div class="form-group">
                    <label for="due_date">Tanggal Pengembalian</label>
                    <input type="date" id="due_date" name="due_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                    <small>Maksimal peminjaman 14 hari</small>
                </div>

                <div class="form-group">
                    <label for="notes">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" placeholder="Contoh: untuk tugas akhir, ujian, atau baca santai..."></textarea>
                </div>

                <div class="btn-group">
                    <a href="{{ route('user.books.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
