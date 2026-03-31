<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Manajemen Peminjaman</h2>
    </div>

    @if(session('success'))
        <div class="alert"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        @if($borrowings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Cover</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->user->name ?? '-' }}</td>
                    <td>
                        @if($borrowing->book->image)
                            <img src="{{ asset('storage/' . $borrowing->book->image) }}" class="book-thumbnail">
                        @else
                            <div class="no-thumbnail"><i class="fas fa-book"></i></div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $borrowing->book->title ?? '-' }}</td>
                    <td>{{ $borrowing->borrow_date ? \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') : '-' }}</td>
                    <td><span class="status-badge status-{{ $borrowing->status }}">{{ ucfirst($borrowing->status) }}</span></td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            @if($borrowing->status == 'menunggu')
                                <form action="{{ route('petugas.borrowings.confirm', $borrowing) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-approve">Setujui</button>
                                </form>
                                <form action="{{ route('petugas.borrowings.reject', $borrowing) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-reject">Tolak</button>
                                </form>
                            @elseif($borrowing->status == 'dipinjam')
                                <form action="{{ route('petugas.borrowings.return', $borrowing) }}" method="POST"
                                      onsubmit="return confirm('Selesaikan pengembalian buku?')">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-approve" style="background: #fff7ed; color: #ea580c;">Kembalikan</button>
                                </form>
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="padding: 40px; text-align: center; color: #6b7280;">Tidak ada data peminjaman</div>
        @endif
    </div>
</div>

</body>
</html>
