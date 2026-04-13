<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function login()
    {
        return view('Admin.login');
    }

    /**
     * Handle proses login
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            
            // Redirect ke dashboard admin jika user adalah admin
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard')->with('success', 'Selamat datang ' . $user->name);
            }
            
            // Redirect ke dashboard user regular untuk kader dan bidan
            return redirect()->intended('dashboard')->with('success', 'Selamat datang ' . $user->name);
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid',
        ])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout');
    }
}
