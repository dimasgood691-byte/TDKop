<x-layouts.app title="Login TDKop">
    <div class="min-h-screen flex items-center justify-center bg-slate-50 p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-100" data-aos="fade-up">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-tdkop-navy">Login TDKop</h1>
                <p class="text-slate-500 mt-2">Selamat datang kembali di Koperasi SMK 8</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username / NIS</label>
                    <input type="text" name="username" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-tdkop-primary focus:border-tdkop-primary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-tdkop-primary focus:border-tdkop-primary outline-none">
                </div>
                <button type="submit" class="w-full bg-tdkop-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition duration-300 shadow-md">
                    Masuk Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-tdkop-accent font-semibold hover:underline">Daftar Siswa</a>
            </p>
        </div>
    </div>
</x-layouts.app>