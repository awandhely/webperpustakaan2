<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // TAMPIL SEMUA USER
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // FORM TAMBAH USER
    public function create()
    {
        return view('admin.users.create');
    }

    // SIMPAN USER BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/admin/users')->with('success', 'User berhasil ditambahkan');
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
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/admin/users')->with('success', 'User berhasil diupdate');
    }

    // HAPUS USER
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('success', 'User berhasil dihapus');
    }
}

