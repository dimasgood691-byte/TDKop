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
        // Validasi input login secara ketat
        $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
            'role'     => ['required', 'string', 'in:admin,siswa'],
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $selectedRole = $request->input('role');
        $remember = $request->boolean('remember');

        if ($selectedRole === 'admin') {
            $authenticated = Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'admin'], $remember)
                || Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'guru'], $remember);

            if ($authenticated) {
                $request->session()->regenerate(); // Regenerasi session ID demi keamanan
                return redirect()->intended(route('admin.dashboard'));
            }
        } else {
            if (Auth::attempt(['username' => $username, 'password' => $password, 'role' => 'siswa'], $remember)) {
                $request->session()->regenerate(); // Regenerasi session ID demi keamanan
                return redirect()->intended(route('siswa.dashboard'));
            }
        }

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
            'name'     => 'required|string|max:255',
            'nis'      => 'required|string|max:50|unique:users,nis',
            'class'    => 'required|string|max:50',
            'major'    => 'required|string|max:100',
            'gender'   => 'required|in:L,P', // <-- Validasi Jenis Kelamin (L/P)
            'username' => 'required|string|max:50|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user tanpa mengizinkan penyerang mengatur 'role' dari request
        $user = User::create([
            'name'     => $data['name'],
            'nis'      => $data['nis'],
            'class'    => $data['class'],
            'major'    => $data['major'],
            'gender'   => $data['gender'], // <-- Menyimpan input Gender ke database
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Set role siswa secara eksplisit di server
        $user->role = 'siswa';
        $user->save();

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