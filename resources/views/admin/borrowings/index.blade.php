@include('admin.sidebar')

<style>
.container {
    margin-left: 280px;
    padding: 30px;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

th {
    background: #f1f5f9;
    text-align: left;
}

.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.badge.menunggu { background: #fef3c7; color: #92400e; }
.badge.dipinjam { background: #dcfce7; color: #166534; }
.badge.ditolak { background: #fee2e2; color: #991b1b; }
.badge.dikembalikan { background: #e0e7ff; color: #3730a3; }

.btn {
    padding: 6px 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 13px;
}

.btn.confirm { background: #22c55e; color: #fff; }
.btn.reject { background: #ef4444; color: #fff; }
.btn.return { background: #3b82f6; color: #fff; }
</style>

<div class="container">
    <h2>📚 Data Peminjaman Buku</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($borrowings as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>
                        <span class="badge {{ $item->status }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        @if($item->status === 'menunggu')
                            <form method="POST" action="{{ route('admin.borrowings.confirm', $item->id) }}" style="display:inline">
                                @csrf @method('PATCH')
                                <button class="btn confirm">✔ Konfirmasi</button>
                            </form>

                            <form method="POST" action="{{ route('admin.borrowings.reject', $item->id) }}" style="display:inline">
                                @csrf @method('PATCH')
                                <button class="btn reject">✖ Tolak</button>
                            </form>
                        @elseif($item->status === 'dipinjam')
                            <form method="POST" action="{{ route('admin.borrowings.return', $item->id) }}">
                                @csrf @method('PATCH')
                                <button class="btn return">↩ Kembalikan</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" align="center">Belum ada data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
