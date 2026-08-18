<x-layouts.app title="Atur Ulang Kata Sandi - TDKop">
    <div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-md border border-slate-100">

            <h1 class="text-2xl font-bold text-tdkop-navy mb-2">Atur Ulang Kata Sandi</h1>
            <p class="text-xs text-slate-500 mb-6">Silakan buat kata sandi baru untuk akun Anda.</p>

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3.5 rounded-xl mb-5 text-xs font-medium border border-red-200">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                        class="w-full px-4 py-2.5 bg-slate-100 border border-slate-300 rounded-xl text-sm text-slate-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-tdkop-primary/40 focus:border-tdkop-primary">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-tdkop-primary/40 focus:border-tdkop-primary">
                </div>

                <button type="submit" class="w-full bg-tdkop-primary hover:bg-tdkop-navy text-white font-semibold py-3 rounded-xl text-sm transition shadow-md">
                    Simpan Kata Sandi Baru
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>