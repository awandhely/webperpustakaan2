<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Peminjaman Buku</title>
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Web Perpustakaan</h1>
            <p>Bukti Resmi Peminjaman Buku Koleksi Perpustakaan</p>
        </div>

        <div class="receipt-info">
            <div>
                <strong>Tanggal Cetak:</strong> {{ now()->format('d F Y') }}
            </div>
            <div class="receipt-number">
                BKT-{{ str_pad($borrowing->id, 5, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <div class="section-title">Informasi Peminjam</div>
        <table>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $borrowing->user->name }}</td>
            </tr>
            <tr>
                <th>Email / User ID</th>
                <td>{{ $borrowing->user->email }}</td>
            </tr>
        </table>

        <div class="section-title">Detail Buku</div>
        <table>
            <tr>
                <th>Judul Buku</th>
                <td>{{ $borrowing->book->title }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $borrowing->book->category->name }}</td>
            </tr>
            <tr>
                <th>Penulis</th>
                <td>{{ $borrowing->book->author }}</td>
            </tr>
        </table>

        <div class="section-title">Status Peminjaman</div>
        <table>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Batas Pengembalian</th>
                <td>{{ \Carbon\Carbon::parse($borrowing->return_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="status-badge {{ $borrowing->status == 'menunggu' ? 'status-menunggu' : 'status-dipinjam' }}">
                        {{ strtoupper($borrowing->status) }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="signature-area">
            <div class="signature-box">
                <p>Petugas Perpustakaan,</p>
                <div class="signature-line"></div>
                <p>( ........................... )</p>
            </div>
        </div>
        <div class="clear"></div>

        <div class="footer">
            <p>Harap simpan bukti ini untuk ditunjukkan saat pengambilan atau pengembalian buku.</p>
            <p>&copy; {{ date('Y') }} Web Perpustakaan Digital</p>
        </div>
    </div>
</body>
</html>
