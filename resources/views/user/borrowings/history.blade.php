<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Peminjaman - {{ auth()->user()->name }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('user.navbar')

@php
    use App\Models\Borrowing;
    $userId = auth()->id();
    $totalAll     = Borrowing::where('user_id', $userId)->count();
    $totalMenunggu = Borrowing::where('user_id', $userId)->where('status', 'menunggu')->count();
    $totalDipinjam = Borrowing::where('user_id', $userId)->where('status', 'dipinjam')->count();
    $totalDikembalikan = Borrowing::where('user_id', $userId)->where('status', 'dikembalikan')->count();
    $totalDitolak = Borrowing::where('user_id', $userId)->where('status', 'ditolak')->count();
@endphp

<div class="main-container">
    <div class="header">
        <h2><i class="fas fa-history" style="color: #f97316;"></i> History Peminjaman</h2>
        <p>Riwayat lengkap peminjaman buku Anda</p>
    </div>

    {{-- Summary Cards --}}
    <div class="summary-cards">
        <div class="summary-card">
            <div class="icon icon-menunggu"><i class="fas fa-clock"></i></div>
            <div class="count">{{ $totalMenunggu }}</div>
            <div class="label">Menunggu</div>
        </div>
        <div class="summary-card">
            <div class="icon icon-dipinjam"><i class="fas fa-book-open"></i></div>
            <div class="count">{{ $totalDipinjam }}</div>
            <div class="label">Dipinjam</div>
        </div>
        <div class="summary-card">
            <div class="icon icon-dikembalikan"><i class="fas fa-check-circle"></i></div>
            <div class="count">{{ $totalDikembalikan }}</div>
            <div class="label">Dikembalikan</div>
        </div>
        <div class="summary-card">
            <div class="icon icon-ditolak"><i class="fas fa-times-circle"></i></div>
            <div class="count">{{ $totalDitolak }}</div>
            <div class="label">Ditolak</div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar">
        <a href="{{ route('user.borrowings.history') }}" class="filter-btn {{ !request('status') ? 'active' : '' }}">
            Semua ({{ $totalAll }})
        </a>
        <a href="{{ route('user.borrowings.history', ['status' => 'menunggu']) }}" class="filter-btn {{ request('status') == 'menunggu' ? 'active' : '' }}">
            Menunggu
        </a>
        <a href="{{ route('user.borrowings.history', ['status' => 'dipinjam']) }}" class="filter-btn {{ request('status') == 'dipinjam' ? 'active' : '' }}">
            Dipinjam
        </a>
        <a href="{{ route('user.borrowings.history', ['status' => 'dikembalikan']) }}" class="filter-btn {{ request('status') == 'dikembalikan' ? 'active' : '' }}">
            Dikembalikan
        </a>
        <a href="{{ route('user.borrowings.history', ['status' => 'ditolak']) }}" class="filter-btn {{ request('status') == 'ditolak' ? 'active' : '' }}">
            Ditolak
        </a>
    </div>

    {{-- Table --}}
    <div class="table-wrapper">
        @if($borrowings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th>Dikembalikan</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $index => $borrowing)
                <tr>
                    <td class="row-number">{{ $index + 1 }}</td>
                    <td>
                        @if($borrowing->book->image)
                            <img src="{{ asset('storage/' . $borrowing->book->image) }}" class="book-thumbnail" alt="{{ $borrowing->book->title }}">
                        @else
                            <div class="no-thumbnail">
                                <i class="fas fa-book"></i>
                            </div>
                        @endif
                    </td>
                    <td class="book-title-cell">{{ $borrowing->book->title ?? '-' }}</td>
                    <td class="date-cell">
                        @if($borrowing->borrow_date)
                            {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td class="date-cell">
                        @if($borrowing->borrow_date)
                            @php
                                $dueDate = \Carbon\Carbon::parse($borrowing->borrow_date)->addDays(7);
                                $isOverdue = $borrowing->status === 'dipinjam' && $dueDate->isPast();
                            @endphp
                            {{ $dueDate->format('d M Y') }}
                            @if($isOverdue)
                                <br><span class="overdue"><i class="fas fa-exclamation-triangle"></i> Terlambat</span>
                            @endif
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ $borrowing->status }}">
                            {{ ucfirst($borrowing->status) }}
                        </span>
                    </td>
                    <td class="date-cell">
                        @if($borrowing->return_date)
                            {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td>
                        @if($borrowing->status === 'dikembalikan')
                            @php
                                $existingRating = \App\Models\BookRating::where('user_id', auth()->id())
                                    ->where('book_id', $borrowing->book_id)
                                    ->first();
                            @endphp

                            @if($existingRating)
                                <div style="color: #f59e0b;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $existingRating->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    <div style="font-size: 11px; color: #6b7280; margin-top: 4px;">Terimakasih!</div>
                                </div>
                            @else
                                <button type="button" 
                                        onclick="openRatingModal({{ $borrowing->book_id }}, '{{ $borrowing->book->title }}')"
                                        style="background: #f97316; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; transition: background 0.2s;">
                                    Beri Rating
                                </button>
                            @endif
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td>
                        @if(in_array($borrowing->status, ['menunggu', 'dipinjam']))
                            <a href="{{ route('user.borrowings.download', $borrowing->id) }}" 
                               class="filter-btn active" 
                               style="padding: 6px 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-file-pdf"></i> Cetak Bukti
                            </a>
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Belum ada riwayat peminjaman</p>
            <small>
                @if(request('status'))
                    Tidak ada data dengan status "{{ ucfirst(request('status')) }}"
                @else
                    Mulai pinjam buku dari halaman <a href="{{ route('user.books.index') }}" style="color: #f97316; text-decoration: underline;">Daftar Buku</a>
                @endif
            </small>
        </div>
        @endif
    </div>
</div>

{{-- Rating Modal --}}
<div id="ratingModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Beri Rating Buku</h3>
            <span class="close-modal" onclick="closeRatingModal()">&times;</span>
        </div>
        <form id="ratingForm" method="POST">
            @csrf
            <p id="modalBookTitle" style="font-size: 14px; color: #6b7280; margin-bottom: 20px; text-align: center;"></p>
            
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" required /><label for="star5" class="fas fa-star"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" class="fas fa-star"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" class="fas fa-star"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" class="fas fa-star"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" class="fas fa-star"></label>
            </div>

            <div class="form-group">
                <label for="review">Ulasan (Opsional)</label>
                <textarea name="review" id="review" class="form-control" rows="3" placeholder="Apa pendapatmu tentang buku ini?"></textarea>
            </div>

            <button type="submit" class="btn-submit">Kirim Rating</button>
        </form>
    </div>
</div>

<script>
    function openRatingModal(bookId, bookTitle) {
        const modal = document.getElementById('ratingModal');
        const form = document.getElementById('ratingForm');
        const titlePlaceholder = document.getElementById('modalBookTitle');
        
        form.action = `/user/books/${bookId}/rate`;
        titlePlaceholder.textContent = bookTitle;
        modal.style.display = 'flex';
    }

    function closeRatingModal() {
        const modal = document.getElementById('ratingModal');
        modal.style.display = 'none';
        document.getElementById('ratingForm').reset();
    }

    // Close on click outside
    window.onclick = function(event) {
        const modal = document.getElementById('ratingModal');
        if (event.target == modal) {
            closeRatingModal();
        }
    }
</script>

</body>
</html>
