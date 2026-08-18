<x-layouts.app title="Lupa Kata Sandi - TDKop">
    <div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-md border border-slate-100">

            <a href="{{ route('login') }}" class="text-xs text-slate-400 hover:text-tdkop-primary font-semibold flex items-center gap-1 mb-6">
                ← Kembali ke Login
            </a>

            <h1 class="text-2xl font-bold text-tdkop-navy mb-2">Lupa Kata Sandi?</h1>
            <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                Masukkan alamat email yang terdaftar pada akun TDKop Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
            </p>

            @if (session('status'))
            <div class="bg-emerald-50 text-emerald-700 p-3.5 rounded-xl mb-5 text-xs font-medium border border-emerald-200">
                ✓ {{ session('status') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3.5 rounded-xl mb-5 text-xs font-medium border border-red-200">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@siswa.smkn8jkt.sch.id"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-tdkop-primary/40 focus:border-tdkop-primary">
                </div>

                <button type="submit" class="w-full bg-tdkop-primary hover:bg-tdkop-navy text-white font-semibold py-3 rounded-xl text-sm transition shadow-md">
                    Kirim Tautan Reset Password
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>