<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/simple-orange.css') }}">
</head>
<body>

@include('admin.sidebar')

<div class="main-container">
    <div class="header">
        <h2>{{ $title }}</h2>
        <div class="actions" style="display:flex; gap:12px;">
            @if($role != 'admin')
            <a href="{{ route('admin.users.export', ['role' => $role]) }}" class="btn-add" style="background: linear-gradient(135deg, #10b981, #059669);">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            @endif

            @if($role == 'petugas')
            <a href="{{ route('admin.users.create', ['role' => $role]) }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah {{ $role == 'petugas' ? 'Petugas' : ($role == 'user' ? 'Anggota' : ($role == 'admin' ? 'Admin' : 'Pengguna')) }}
            </a>
            @endif
        </div>
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
                    <th>Terdaftar</th>
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
                                <div class="user-email">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->alamat ?? '-' }}</td>
                    <td>
                        <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="actions">
                            @if($role != 'user')
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit">Edit</a>
                            @endif

                            @if($role != 'admin' && $user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
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