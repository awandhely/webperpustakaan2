<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserManagementController extends Controller
{
    // EXPORT EXCEL
    public function export(Request $request)
    {
        $role = $request->query('role');
        $fileName = 'users';
        if ($role) {
            $fileName .= '_' . $role;
        }
        $fileName .= '_' . date('Y-m-d') . '.xlsx';

        return Excel::download(new UsersExport($role), $fileName);
    }

    // TAMPIL SEMUA USER
    public function index(Request $request)
    {
        $role = $request->query('role') ?? 'admin';
        $users = User::where('role', $role)->get();
        
        $title = $role == 'petugas' ? 'Data Petugas' : ($role == 'user' ? 'Data Anggota' : 'Data Admin');
        
        return view('admin.users.index', compact('users', 'title', 'role'));
    }

    // FORM TAMBAH USER
    public function create(Request $request)
    {
        $role = $request->query('role');
        return view('admin.users.create', compact('role'));
    }

    // SIMPAN USER BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'petugas', 
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.users.index', ['role' => $request->role ?? 'petugas'])->with('success', 'User berhasil ditambahkan');
    }

    // FORM EDIT USER
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // UPDATE USER
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'alamat' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'alamat' => $request->alamat,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index', ['role' => $user->role])->with('success', 'User berhasil diupdate');
    }

    // HAPUS USER
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('success', 'User berhasil dihapus');
    }
}

