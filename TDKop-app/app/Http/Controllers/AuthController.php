<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input termasuk field 'role' dari form
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'role'     => ['required', 'string'],
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $selectedRole = $request->input('role');
        $remember = $request->has('remember');

        // 2. Jika user memilih tab Admin/Staff, izinkan login untuk role 'admin' ATAU 'guru'
        if ($selectedRole === 'admin') {
            $authenticated = Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'admin'], $remember)
                || Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'guru'], $remember);

            if ($authenticated) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard/admin');
            }
        }
        // 3. Jika user memilih tab Siswa, pastikan role di DB adalah 'siswa'
        else {
            if (Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'siswa'], $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard/siswa');
            }
        }

        // 4. Jika username/password salah ATAU role tidak cocok
        return back()->withErrors([
            'username' => 'Username, kata sandi, atau peran (role) yang dipilih tidak cocok.'
        ])->onlyInput('username');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'nis' => 'required|unique:users',
            'class' => 'required',
            'major' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'nis' => $data['nis'],
            'class' => $data['class'],
            'major' => $data['major'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'siswa',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}