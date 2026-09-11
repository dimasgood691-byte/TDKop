<x-layouts.app title="Atur Ulang Kata Sandi - TDKop">
    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-6 font-sans overflow-hidden bg-gradient-to-br from-slate-50 via-sky-50/50 to-slate-100/60"
         x-data="{ showPassword: false, showPasswordConfirm: false, pwLength: 0 }">

        <!-- Background Ambient Glows & Dot Grid -->
        <div class="absolute inset-0 bg-[radial-gradient(#94a3b8_1px,transparent_1px)] bg-[size:28px_28px] opacity-20 pointer-events-none"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-tdkop-primary/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-tdkop-accent/15 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Main Card Container -->
        <div class="relative z-10 w-full max-w-lg bg-white/85 backdrop-blur-xl p-7 sm:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-white/80" data-aos="fade-up">

            <!-- Back to Login Button -->
            <div class="mb-6">
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-50 hover:bg-tdkop-primary hover:text-white border border-slate-200 text-xs font-bold text-slate-600 transition-all duration-300 shadow-2xs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="transition-transform group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    Batal & Ke Login
                </a>
            </div>

            <!-- Header Info -->
            <div class="text-center mb-8">
                <div class="relative inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 mb-4 group cursor-default">
                    <div class="absolute inset-0 bg-tdkop-primary/10 rounded-full scale-100 transition-transform duration-500 group-hover:scale-110"></div>
                    <div class="relative z-10 w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-tr from-tdkop-navy to-tdkop-primary rounded-2xl shadow-lg shadow-blue-900/20 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                </div>

                <h1 class="text-2xl sm:text-3xl font-black text-tdkop-navy tracking-tight mb-2">Kata Sandi Baru</h1>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-sm mx-auto">
                    Buat kata sandi baru yang kuat dan aman untuk akun TDKop kamu.
                </p>
            </div>

            <!-- Alert Errors -->
            @if ($errors->any())
            <div class="flex items-start gap-3 bg-rose-50 text-rose-700 p-4 rounded-2xl mb-6 text-xs sm:text-sm font-semibold border border-rose-200 shadow-2xs">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" class="shrink-0 mt-0.5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" x2="12" y1="8" x2="12"/>
                    <line x1="12" x2="12.01" y1="16" x2="16"/>
                </svg>
                <p class="leading-relaxed">{{ $errors->first() }}</p>
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email (Readonly) -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" readonly
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-500 cursor-not-allowed outline-none select-none">
                    </div>
                </div>

                <!-- Kata Sandi Baru -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Kata Sandi Baru <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input :type="showPassword ? 'text' : 'password'" name="password" required minlength="8" placeholder="Minimal 8 karakter"
                            @input="pwLength = $event.target.value.length"
                            class="w-full pl-10 pr-11 py-2.5 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 outline-none transition-all">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-tdkop-primary transition-all active:scale-95 cursor-pointer">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 7 10 7a13.16 13.16 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                <path d="M1 1l22 22" />
                                <path d="M6.06 6.06A13.9 13.9 0 0 0 2 11s3.5 7 10 7a9.14 9.14 0 0 0 5-1.5" />
                            </svg>
                        </button>
                    </div>

                    <!-- Password Strength Bar -->
                    <div class="mt-2 space-y-1">
                        <div class="flex justify-between text-[11px] font-bold text-slate-400">
                            <span>Kekuatan Kata Sandi</span>
                            <span x-text="pwLength >= 8 ? 'Kuat ✓' : pwLength + '/8 Karakter'"
                                  :class="pwLength >= 8 ? 'text-emerald-600' : 'text-slate-400'"></span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full transition-all duration-300 rounded-full"
                                 :class="pwLength >= 8 ? 'bg-emerald-500 w-full' : (pwLength > 0 ? 'bg-amber-400' : 'bg-slate-200')"
                                 :style="'width: ' + Math.min(100, (pwLength / 8) * 100) + '%'"></div>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Konfirmasi Kata Sandi <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input :type="showPasswordConfirm ? 'text' : 'password'" name="password_confirmation" required minlength="8" placeholder="Ulangi kata sandi"
                            class="w-full pl-10 pr-11 py-2.5 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 outline-none transition-all">
                        <button type="button" @click="showPasswordConfirm = !showPasswordConfirm"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-tdkop-primary transition-all active:scale-95 cursor-pointer">
                            <svg x-show="!showPasswordConfirm" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg x-show="showPasswordConfirm" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 7 10 7a13.16 13.16 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                <path d="M1 1l22 22" />
                                <path d="M6.06 6.06A13.9 13.9 0 0 0 2 11s3.5 7 10 7a9.14 9.14 0 0 0 5-1.5" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="relative group overflow-hidden w-full bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-900 text-white font-extrabold py-3.5 rounded-xl text-xs sm:text-sm shadow-md shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-600/40 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer mt-2">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></span>
                    <span class="relative z-10">Simpan Kata Sandi Baru</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="relative z-10 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                    </svg>
                </button>
            </form>

        </div>
    </div>
</x-layouts.app>
