<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku - {{ $book->title }}</title>
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
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
                    <label for="borrow_date">Tanggal Meminjam</label>
                    <input type="date" id="borrow_date" name="borrow_date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                    <small>Tanggal mulai peminjaman buku</small>
                </div>

                <div class="form-group">
                    <label for="return_date">Tanggal Pengembalian</label>
                    <input type="date" id="return_date" name="return_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
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
