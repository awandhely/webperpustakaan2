<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota - Petugas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('petugas.sidebar')

<div class="main-container">
    <div class="header">
        <h2>Daftar Anggota</h2>
        <a href="{{ route('petugas.users.export') }}" class="btn-add" style="background: linear-gradient(135deg, #10b981, #059669);">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
                            <div>
                                <div class="user-name">{{ $user->name }}</div>
                                <div style="font-size:12px;color:#6b7280;">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->alamat ?? '-' }}</td>
                    <td><span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('petugas.users.edit', $user) }}" class="btn btn-edit">Edit</a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('petugas.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus anggota?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
