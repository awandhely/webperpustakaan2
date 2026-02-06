<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .container {
            margin-left: 260px;
            padding: 30px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
            margin-bottom: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            background: #2563eb;
            color: white;
        }

        .btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: #6b7280;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal.active {
            display: flex;
        }

        .modal-box {
            background: white;
            padding: 25px;
            border-radius: 14px;
            width: 380px;
            max-width: 90%;
        }

        .modal-box h3 {
            margin-top: 0;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            font-weight: 500;
            font-size: 0.95em;
        }

        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1em;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        small {
            color: #6b7280;
            font-size: 0.85em;
        }
    </style>
</head>

<body>

@include('user.sidebar')

<div class="container">
    <h2>📚 Daftar Buku</h2>

    @if(session('success'))
        <p style="color:green; font-weight:500;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red; font-weight:500;">{{ session('error') }}</p>
    @endif

    @foreach($books as $book)
        <div class="card">
            <img src="{{ $book->image ? asset('storage/'.$book->image) : 'https://via.placeholder.com/120x160' }}">

            <div style="flex:1;">
                <h3 style="margin:0 0 6px;">{{ $book->title }}</h3>
                <p style="margin:4px 0; color:#4b5563;">✍ {{ $book->author }}</p>
                <p style="margin:4px 0; font-weight:500;">📦 Stok: {{ $book->stock }}</p>

                <div style="display:flex; gap:10px; margin-top:12px; flex-wrap:wrap;">
                    <a href="{{ route('user.books.show', $book) }}" class="btn" style="background:#6366f1;">
                        📖 Lihat Detail
                    </a>
                    @if($book->stock > 0)
                        <button class="btn"
                            onclick="openModal({{ $book->id }}, '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}')">
                            📥 Pinjam Buku
                        </button>
                    @else
                        <button class="btn" disabled>Stok Habis</button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- MODAL -->
<div class="modal" id="borrowModal">
    <div class="modal-box">
        <h3>📥 Konfirmasi Peminjaman</h3>

        <p><strong>Judul:</strong> <span id="modalTitle"></span></p>
        <p><strong>Penulis:</strong> <span id="modalAuthor"></span></p>

        <form method="POST" id="borrowForm">
            @csrf

            <label>Jumlah yang dipinjam</label>
            <input type="number" name="quantity" min="1" value="1" required>

            <label>Tanggal Pengembalian</label>
            <input type="date" name="due_date" required 
                   value="{{ date('Y-m-d', strtotime('+7 days')) }}">

            <label>Catatan (opsional)</label>
            <textarea name="notes" rows="3" placeholder="Contoh: untuk tugas akhir, ujian, atau baca santai..."></textarea>

            <button type="submit" class="btn" style="width:100%; margin:20px 0 10px;">
                Ajukan Peminjaman
            </button>

            <button type="button" class="btn btn-secondary" style="width:100%;"
                onclick="closeModal()">Batal</button>
        </form>
    </div>
</div>

<script>
function openModal(id, title, author) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalAuthor').innerText = author;
    
    // Set action URL
    document.getElementById('borrowForm').action = `/user/books/${id}/borrow`;
    
    // Reset form fields jika diperlukan
    document.getElementById('borrowForm').reset();
    
    // Set default quantity dan tanggal
    document.querySelector('input[name="quantity"]').value = 1;
    document.querySelector('input[name="due_date"]').value = new Date(Date.now() + 7*24*60*60*1000).toISOString().split('T')[0];
    
    document.getElementById('borrowModal').classList.add('active');
}

function closeModal() {
    document.getElementById('borrowModal').classList.remove('active');
}

// Optional: tutup modal jika klik di luar box
document.getElementById('borrowModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>

</body>
</html>