<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - {{ $book->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
            min-height: 100vh;
            padding-left: 280px;
            transition: padding-left 0.3s ease;
        }

        @media (max-width: 1024px) {
            body {
                padding-left: 80px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 24px;
            padding: 10px 16px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            background: #f1f5f9;
            transform: translateX(-4px);
        }

        .detail-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 0;
        }

        @media (max-width: 900px) {
            .detail-card {
                grid-template-columns: 1fr;
            }
        }

        .book-cover-section {
            background: linear-gradient(145deg, #1e293b, #334155);
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
        }

        .book-cover-section img {
            width: 220px;
            height: 320px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
            transition: transform 0.3s ease;
        }

        .book-cover-section img:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .no-cover {
            width: 220px;
            height: 320px;
            background: linear-gradient(145deg, #475569, #64748b);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }

        .book-info-section {
            padding: 40px;
        }

        .book-title {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .book-author {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .category-badge {
            display: inline-block;
            padding: 8px 18px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 32px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .info-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .info-item:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .info-label {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 18px;
            color: #1e293b;
            font-weight: 700;
        }

        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .stock-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .stock-available {
            background: #22c55e;
        }

        .stock-low {
            background: #f59e0b;
        }

        .stock-empty {
            background: #ef4444;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 2px solid #f1f5f9;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-edit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-delete:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        .btn-back {
            background: #f1f5f9;
            color: #475569;
            border: 2px solid #e2e8f0;
        }

        .btn-back:hover {
            background: #e2e8f0;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    @include('admin.sidebar')

    <div class="main-container">
        <a href="{{ route('admin.books.index') }}" class="back-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Buku
        </a>

        <div class="detail-card">
            <div class="book-cover-section">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                @else
                    <div class="no-cover">📚</div>
                @endif
            </div>

            <div class="book-info-section">
                <h1 class="book-title">{{ $book->title }}</h1>
                <p class="book-author">✍️ {{ $book->author }}</p>

                @if($book->category)
                    <span class="category-badge">{{ $book->category->name }}</span>
                @endif

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Penerbit</div>
                        <div class="info-value">{{ $book->publisher }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tahun Terbit</div>
                        <div class="info-value">{{ $book->year }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Stok Tersedia</div>
                        <div class="info-value">
                            <span class="stock-indicator">
                                <span class="stock-dot {{ $book->stock > 5 ? 'stock-available' : ($book->stock > 0 ? 'stock-low' : 'stock-empty') }}"></span>
                                {{ $book->stock }} eksemplar
                            </span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">ID Buku</div>
                        <div class="info-value">#{{ $book->id }}</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-edit">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Buku
                    </a>
                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus buku «{{ $book->title }}»?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Buku
                        </button>
                    </form>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-back">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
