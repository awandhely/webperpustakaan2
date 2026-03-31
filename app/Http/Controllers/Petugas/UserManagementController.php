<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserManagementController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport('user'), 'anggota_perpustakaan_' . date('Y-m-d') . '.xlsx');
    }

    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('petugas.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('petugas.users.edit', compact('user'));
    }

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

        return redirect()->route('petugas.users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('petugas.users.index')->with('success', 'User berhasil dihapus');
    }
}
