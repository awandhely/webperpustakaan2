<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Detail Buku</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            margin: 0;
        }

        .container {
            margin-left: 260px;
            padding: 30px;
            max-width: 1100px;
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            transition: all 0.2s ease;
        }

        .back-link:hover {
            background: #f1f5f9;
            transform: translateX(-4px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .book-detail {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.12);
        }

        .book-header {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            padding: 50px 40px;
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        @media (max-width: 700px) {
            .book-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 40px 24px;
            }
        }

        .book-cover {
            flex-shrink: 0;
        }

        .book-cover img {
            width: 200px;
            height: 280px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            transition: transform 0.4s ease;
        }

        .book-cover img:hover {
            transform: scale(1.08) rotate(-3deg);
        }

        .book-cover .no-image {
            width: 200px;
            height: 280px;
            background: linear-gradient(145deg, #334155, #475569);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 72px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        .book-header-info {
            color: white;
            flex: 1;
        }

        .book-header-info h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .book-author {
            font-size: 20px;
            color: #94a3b8;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .category-tag {
            display: inline-block;
            padding: 10px 22px;
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            color: white;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
        }

        .book-body {
            padding: 40px;
        }

        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .info-card {
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            text-align: center;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            border-color: transparent;
            background: linear-gradient(145deg, #eff6ff, #dbeafe);
        }

        .info-card .icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .info-card .label {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .info-card .value {
            font-size: 22px;
            color: #1e293b;
            font-weight: 700;
        }

        .stock-status {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .stock-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .stock-available {
            background: #dcfce7;
            color: #166534;
        }

        .stock-low {
            background: #fef3c7;
            color: #92400e;
        }

        .stock-empty {
            background: #fee2e2;
            color: #991b1b;
        }

        .borrow-section {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 20px;
            padding: 32px;
            text-align: center;
            border: 2px solid #bfdbfe;
        }

        .borrow-section h3 {
            font-size: 22px;
            color: #1e40af;
            margin-bottom: 16px;
        }

        .borrow-section p {
            color: #3b82f6;
            margin-bottom: 24px;
            font-size: 16px;
        }

        .btn-borrow {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 40px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            text-decoration: none;
            border-radius: 14px;
            font-size: 17px;
            font-weight: 700;
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-borrow:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 45px rgba(37, 99, 235, 0.5);
        }

        .btn-borrow:disabled {
            background: linear-gradient(135deg, #94a3b8, #64748b);
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            background: white;
            color: #475569;
            text-decoration: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            margin-top: 20px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Alert messages */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
    </style>
</head>
<body>

@include('user.sidebar')

<div class="container">
    <a href="{{ route('user.books.index') }}" class="back-link">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Buku
    </a>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    <div class="book-detail">
        <div class="book-header">
            <div class="book-cover">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                @else
                    <div class="no-image">📚</div>
                @endif
            </div>

            <div class="book-header-info">
                <h1>{{ $book->title }}</h1>
                <p class="book-author">✍️ {{ $book->author }}</p>
                
                @if($book->category)
                    <span class="category-tag">{{ $book->category->name }}</span>
                @endif
            </div>
        </div>

        <div class="book-body">
            <div class="info-cards">
                <div class="info-card">
                    <div class="icon">🏢</div>
                    <div class="label">Penerbit</div>
                    <div class="value">{{ $book->publisher }}</div>
                </div>
                <div class="info-card">
                    <div class="icon">📅</div>
                    <div class="label">Tahun Terbit</div>
                    <div class="value">{{ $book->year }}</div>
                </div>
                <div class="info-card">
                    <div class="icon">📦</div>
                    <div class="label">Stok Tersedia</div>
                    <div class="value">
                        <div class="stock-status">
                            <span class="stock-badge {{ $book->stock > 5 ? 'stock-available' : ($book->stock > 0 ? 'stock-low' : 'stock-empty') }}">
                                {{ $book->stock }} eksemplar
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="borrow-section">
                <h3>📥 Ingin Meminjam Buku Ini?</h3>
                <p>Klik tombol di bawah untuk mengajukan peminjaman buku.</p>
                
                @if($book->stock > 0)
                    <a href="{{ route('user.books.borrow.form', $book) }}" class="btn-borrow">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Pinjam Buku Ini
                    </a>
                @else
                    <button class="btn-borrow" disabled>
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Stok Habis
                    </button>
                @endif

                <br>
                <a href="{{ route('user.books.index') }}" class="btn-back">
                    Kembali ke Daftar Buku
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
