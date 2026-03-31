<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Peminjaman Buku</h2>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="filter-bar">
        <a href="{{ route('admin.borrowings.index') }}" class="filter-btn {{ !request('status') ? 'active' : '' }}">Semua</a>
        <a href="{{ route('admin.borrowings.index', ['status' => 'menunggu']) }}" class="filter-btn {{ request('status') == 'menunggu' ? 'active' : '' }}">Menunggu</a>
        <a href="{{ route('admin.borrowings.index', ['status' => 'dipinjam']) }}" class="filter-btn {{ request('status') == 'dipinjam' ? 'active' : '' }}">Dipinjam</a>
        <a href="{{ route('admin.borrowings.index', ['status' => 'dikembalikan']) }}" class="filter-btn {{ request('status') == 'dikembalikan' ? 'active' : '' }}">Dikembalikan</a>
    </div>

    <div class="table-wrapper">
        @if($borrowings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Cover</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">{{ substr($borrowing->user->name ?? 'U', 0, 1) }}</div>
                            <span>{{ $borrowing->user->name ?? '-' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($borrowing->book->image)
                            <img src="{{ asset('storage/' . $borrowing->book->image) }}" class="book-thumbnail" alt="{{ $borrowing->book->title }}">
                        @else
                            <div class="no-thumbnail">
                                <i class="fas fa-book"></i>
                            </div>
                        @endif
                    </td>
                    <td style="font-weight:500;color:#1f2937;">{{ $borrowing->book->title ?? '-' }}</td>
                    <td>{{ $borrowing->borrow_date ? \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') : '-' }}</td>
                    <td>{{ $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') : '-' }}</td>
                    <td>
                        <span class="status-badge status-{{ $borrowing->status }}">{{ ucfirst($borrowing->status) }}</span>
                    </td>
                    <td>
                        <div class="actions">
                            @if($borrowing->status == 'menunggu')
                                <form action="{{ route('admin.borrowings.confirm', $borrowing) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-approve">Setujui</button>
                                </form>
                                <form action="{{ route('admin.borrowings.reject', $borrowing) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-reject">Tolak</button>
                                </form>
                            @elseif($borrowing->status == 'dipinjam')
                                <form action="{{ route('admin.borrowings.return', $borrowing) }}" method="POST"
                                      onsubmit="return confirm('Selesaikan pengembalian buku &quot;{{ $borrowing->book->title }}&quot;?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-return">Kembalikan</button>
                                </form>
                            @else
                                <span style="color:#9ca3af;font-size:13px;">-</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <i class="fas fa-exchange-alt" style="font-size:48px;color:#d1d5db;margin-bottom:16px;"></i>
            <p>Tidak ada data peminjaman</p>
        </div>
        @endif
    </div>
</div>

</body>
</html>
