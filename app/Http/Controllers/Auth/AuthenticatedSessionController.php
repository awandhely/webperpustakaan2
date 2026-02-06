<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Form login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * LOGIN SEMUA ROLE
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }

        // ✅ USER
        return redirect()->route('user.dashboard');
    }

    /**
     * LOGOUT
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * LOGIN KHUSUS ADMIN & PETUGAS
     */
    public function storeStaff(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }

            // ❌ user biasa ditolak
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun ini bukan admin atau petugas',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }
}
