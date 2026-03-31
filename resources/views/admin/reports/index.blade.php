<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman - Admin Panel</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-content">
    <div class="page-header">
        <div>
            <h1>Laporan Peminjaman</h1>
            <p style="color: #6b7280; margin-top: 4px;">Rekapitulasi seluruh data transaksi perpustakaan</p>
        </div>
        <a href="{{ route('admin.reports.export') }}" class="btn-export">
            <i class="fas fa-file-excel"></i> Export ke Excel
        </a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $index => $borrowing)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $borrowing->user->name ?? '-' }}</div>
                        <div style="font-size: 12px; color: #6b7280;">{{ $borrowing->user->email ?? '-' }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $borrowing->book->title ?? '-' }}</div>
                        <div style="font-size: 12px; color: #6b7280;">{{ $borrowing->book->category->name ?? '-' }}</div>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                    <td>
                        @if($borrowing->return_date)
                            {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                        @else
                            <span style="color: #9ca3af;">Belum Kembali</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ $borrowing->status }}">
                            {{ $borrowing->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">Belum ada data peminjaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
