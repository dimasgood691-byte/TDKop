<x-layouts.app title="Atur Ulang Kata Sandi - TDKop">
    <!-- 1. Wrapper Utama dengan Gradasi & Dot Pattern (Sesuai Forgot Password) -->
    <div class="relative min-h-screen flex items-center justify-center p-6 font-sans overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50/60 to-blue-100/40">
        
        <!-- Background Dot Pattern -->
        <div class="absolute inset-0 z-0" style="background-image: radial-gradient(#94a3b8 1.5px, transparent 1.5px); background-size: 32px 32px; opacity: 0.25;"></div>

        <!-- Ornamen Ambient Glowing Blobs -->
        <div class="absolute top-[-20%] left-[-10%] w-[40rem] h-[40rem] bg-tdkop-primary/15 rounded-full mix-blend-multiply filter blur-[100px] animate-[pulse_6s_ease-in-out_infinite]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[35rem] h-[35rem] bg-blue-400/20 rounded-full mix-blend-multiply filter blur-[90px] animate-[pulse_8s_ease-in-out_infinite]" style="animation-delay: 2s;"></div>
        <div class="absolute top-[20%] right-[10%] w-[25rem] h-[25rem] bg-cyan-300/20 rounded-full mix-blend-multiply filter blur-[80px] animate-[pulse_7s_ease-in-out_infinite]" style="animation-delay: 4s;"></div>

        <!-- 2. Main Card Glassmorphism -->
        <div class="relative z-10 w-full max-w-lg bg-white/70 backdrop-blur-2xl p-8 sm:p-10 rounded-[2rem] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-white/60">
            
            <!-- Tombol Batal/Kembali -->
            <div class="mb-8">
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-sm border border-white/80 text-xs font-bold text-slate-500 hover:bg-tdkop-primary hover:text-white hover:border-tdkop-primary transition-all duration-300 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="transition-transform group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Batal & Ke Login
                </a>
            </div>

            <!-- Header & Ilustrasi Ikon -->
            <div class="text-center mb-8">
                <div class="relative inline-flex items-center justify-center w-20 h-20 mb-5 group cursor-default">
                    <div class="absolute inset-0 bg-tdkop-primary/10 rounded-full scale-100 transition-transform duration-500 group-hover:scale-125"></div>
                    <div class="absolute inset-2 bg-gradient-to-tr from-tdkop-primary/20 to-blue-300/30 rounded-full scale-100 transition-transform duration-500 delay-75 group-hover:scale-110"></div>
                    <div class="relative z-10 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full shadow-md flex items-center justify-center text-tdkop-primary border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><circle cx="12" cy="16" r="1"/></svg>
                    </div>
                </div>

                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-2">Kata Sandi Baru</h1>
                <p class="text-sm text-slate-600 leading-relaxed px-4">
                    Buat kata sandi baru yang aman untuk melindungi akun TDKop kamu.
                </p>
            </div>

            <!-- Alert Error Validasi -->
            @if ($errors->any())
            <div class="animate-fade-in flex items-start gap-3 bg-red-50/80 backdrop-blur-sm text-red-600 p-4 rounded-2xl mb-6 text-sm font-medium border border-red-200/60 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="shrink-0 mt-0.5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                <p class="leading-relaxed">{{ $errors->first() }}</p>
            </div>
            @endif

            <!-- Form Reset Password -->
            <form action="{{ route('password.update') }}" method="POST" class="space-y-5 relative z-20">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- 1. Email (Readonly Display) -->
                <div class="relative group/input">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" readonly
                        class="peer block w-full pl-11 pr-4 pb-2.5 pt-6 text-sm text-slate-500 bg-slate-100/70 rounded-2xl border-2 border-slate-200/60 appearance-none cursor-not-allowed outline-none select-none" placeholder=" " />
                    <label class="absolute text-xs font-semibold text-slate-400 duration-300 transform -translate-y-2.5 scale-90 top-4 z-10 origin-[0] left-11">
                        Alamat Email Akun
                    </label>
                </div>

                <!-- 2. Password Baru + Floating Label + Toggle Eye -->
                <div class="relative group/input">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-tdkop-primary transition-colors z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"/><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"/></svg>
                    </div>

                    <input type="password" id="password" name="password" required onkeyup="checkPasswordStrength(this.value)"
                        class="peer block w-full pl-11 pr-12 pb-2.5 pt-6 text-sm text-slate-900 bg-white/60 backdrop-blur-md rounded-2xl border-2 border-white/80 appearance-none focus:outline-none focus:ring-0 focus:border-tdkop-primary focus:bg-white transition-all shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] hover:bg-white/80" placeholder=" " />
                    
                    <label for="password" class="absolute text-sm text-slate-500 duration-300 transform -translate-y-2.5 scale-75 top-4 z-10 origin-[0] left-11 peer-focus:text-tdkop-primary peer-focus:font-bold peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:font-normal peer-focus:scale-75 peer-focus:-translate-y-2.5 cursor-text">
                        Kata Sandi Baru
                    </label>

                    <button type="button" onclick="togglePassword('password', 'eye-icon-pw')" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-tdkop-primary transition-colors focus:outline-none z-20">
                        <svg id="eye-icon-pw" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                <!-- Indikator Kekuatan Password Sederhana -->
                <div class="px-1 space-y-1.5">
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span>Minimal 8 karakter</span>
                        <span id="pw-length-status" class="font-bold text-slate-400">0/8</span>
                    </div>
                    <div class="w-full h-1.5 bg-slate-200/80 rounded-full overflow-hidden">
                        <div id="pw-bar" class="h-full w-0 bg-slate-300 transition-all duration-300 rounded-full"></div>
                    </div>
                </div>

                <!-- 3. Konfirmasi Password Baru + Floating Label + Toggle Eye -->
                <div class="relative group/input">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-tdkop-primary transition-colors z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
                    </div>

                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                        class="peer block w-full pl-11 pr-12 pb-2.5 pt-6 text-sm text-slate-900 bg-white/60 backdrop-blur-md rounded-2xl border-2 border-white/80 appearance-none focus:outline-none focus:ring-0 focus:border-tdkop-primary focus:bg-white transition-all shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] hover:bg-white/80" placeholder=" " />
                    
                    <label for="password_confirmation" class="absolute text-sm text-slate-500 duration-300 transform -translate-y-2.5 scale-75 top-4 z-10 origin-[0] left-11 peer-focus:text-tdkop-primary peer-focus:font-bold peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:font-normal peer-focus:scale-75 peer-focus:-translate-y-2.5 cursor-text">
                        Ulangi Kata Sandi Baru
                    </label>

                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-tdkop-primary transition-colors focus:outline-none z-20">
                        <svg id="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="group relative w-full flex justify-center items-center gap-2 bg-gradient-to-r from-tdkop-primary to-blue-600 text-white font-bold py-3.5 rounded-2xl text-sm transition-all overflow-hidden shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 active:translate-y-0 border border-white/20 mt-2">
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="relative z-10">Simpan Kata Sandi Baru</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" class="relative z-10 transition-transform duration-300 group-hover:translate-x-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </form>

        </div>
    </div>

    <!-- Script JavaScript untuk Toggle Eye & Password Strength Meter -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="m15 18-.722-3.25"/><path d="M2 12s3-7 10-7c2.663 0 5.093.993 6.941 2.664"/><path d="m22 12s-3 7-10 7c-2.663 0-5.093-.993-6.941-2.664"/><circle cx="12" cy="12" r="3"/><path d="m2 2 20 20"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>';
            }
        }

        function checkPasswordStrength(val) {
            const status = document.getElementById('pw-length-status');
            const bar = document.getElementById('pw-bar');
            const len = val.length;

            status.textContent = `${len}/8`;

            if (len === 0) {
                bar.style.width = '0%';
                bar.className = 'h-full w-0 bg-slate-300 transition-all duration-300 rounded-full';
                status.className = 'font-bold text-slate-400';
            } else if (len < 8) {
                bar.style.width = `${(len / 8) * 100}%`;
                bar.className = 'h-full bg-amber-400 transition-all duration-300 rounded-full';
                status.className = 'font-bold text-amber-500';
            } else {
                bar.style.width = '100%';
                bar.className = 'h-full bg-emerald-500 transition-all duration-300 rounded-full';
                status.className = 'font-bold text-emerald-600';
            }
        }
    </script>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>