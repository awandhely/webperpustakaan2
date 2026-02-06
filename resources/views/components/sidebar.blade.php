<div class="sidebar">
    <h2>📚 Perpustakaan</h2>

    <ul>
        @if(auth()->user()->role === 'admin')
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="#">Kelola Petugas</a></li>
            <li><a href="#">Data Buku</a></li>
            <li><a href="#">Laporan</a></li>
        @endif

        @if(auth()->user()->role === 'petugas')
            <li><a href="/petugas">Dashboard</a></li>
            <li><a href="#">Data Buku</a></li>
            <li><a href="#">Peminjaman</a></li>
        @endif

        @if(auth()->user()->role === 'user')
            <li><a href="/user">Dashboard</a></li>
            <li><a href="#">Cari Buku</a></li>
            <li><a href="#">Riwayat Pinjam</a></li>
        @endif
    </ul>
</div>
