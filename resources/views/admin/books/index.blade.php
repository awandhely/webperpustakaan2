<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f9fafb;
            min-height: 100vh;
            padding-left: 280px; /* Sidebar width */
            transition: padding-left 0.3s ease;
        }

        /* Jika sidebar di-collapse atau di layar kecil */
        @media (max-width: 1024px) {
            body {
                padding-left: 80px; /* Sidebar collapsed width */
            }
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }
        }

        .main-container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .btn-add {
            background: #3b82f6;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-add:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-add svg {
            width: 20px;
            height: 20px;
        }

        .alert {
            background: #ecfdf5;
            border-left: 5px solid #10b981;
            color: #065f46;
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-weight: 500;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .table-wrapper {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }

        th {
            padding: 18px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        td {
            padding: 18px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #374151;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.005);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .book-cover {
            width: 52px;
            height: 74px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .no-image {
            width: 52px;
            height: 74px;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #94a3b8;
        }

        .book-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 15px;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            background: #dbeafe;
            color: #4338ca;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        .btn-edit:hover {
            background: #dbeafe;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .btn-delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 80px 40px;
            color: #94a3b8;
        }

        .empty-state svg {
            width: 90px;
            height: 90px;
            margin-bottom: 20px;
            opacity: 0.4;
        }

        /* Responsif table untuk mobile */
        @media (max-width: 768px) {
            .main-container {
                padding: 20px 16px;
            }

            .header {
                flex-direction: column;
                align-items: stretch;
            }

            .header h2 {
                font-size: 24px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                margin-bottom: 16px;
                padding: 16px;
                background: white;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                width: 45%;
                font-weight: 600;
                color: #475569;
                text-align: left;
            }

            .actions {
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>

    @include('admin.sidebar')

    <div class="main-container">
        <div class="header">
            <h2>📚 Daftar Buku Perpustakaan</h2>
            <a href="/admin/books/create" class="btn-add">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Buku Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td data-label="No">{{ $loop->iteration }}</td>
                            <td data-label="Cover">
                                @if($book->image)
                                    <img src="{{ asset('storage/'.$book->image) }}" class="book-cover" alt="{{ $book->title }}">
                                @else
                                    <div class="no-image">📚</div>
                                @endif
                            </td>
                            <td data-label="Judul" class="book-title">{{ $book->title }}</td>
                            <td data-label="Penulis">{{ $book->author }}</td>
                            <td data-label="Kategori">
                                @if($book->category)
                                    <span class="badge">{{ $book->category->name }}</span>
                                @else
                                    <span class="badge" style="background:#f3f4f6;color:#6b7280;">-</span>
                                @endif
                            </td>
                            <td data-label="Penerbit">{{ $book->publisher }}</td>
                            <td data-label="Tahun">{{ $book->year }}</td>
                            <td data-label="Stok"><strong>{{ $book->stock }}</strong></td>
                            <td data-label="Aksi">
                                <div class="actions">
                                    <a href="/admin/books/{{ $book->id }}" class="btn btn-edit" style="background:#f0fdf4;color:#16a34a;border-color:#bbf7d0;">Detail</a>
                                    <a href="/admin/books/{{ $book->id }}/edit" class="btn btn-edit">Edit</a>
                                    <form action="/admin/books/{{ $book->id }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" 
                                                onclick="return confirm('Yakin ingin menghapus buku «{{ addslashes($book->title) }}»?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <p>Belum ada buku yang ditambahkan ke perpustakaan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>