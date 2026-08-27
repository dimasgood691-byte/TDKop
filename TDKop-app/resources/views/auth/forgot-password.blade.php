<x-layouts.app title="Lupa Kata Sandi - TDKop">
    
    <div class="relative min-h-screen flex items-center justify-center p-6 font-sans overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50/60 to-blue-100/40">
        
        
        <div class="absolute inset-0 z-0" style="background-image: radial-gradient(#94a3b8 1.5px, transparent 1.5px); background-size: 32px 32px; opacity: 0.25;"></div>

        
        <div class="absolute top-[-20%] left-[-10%] w-[40rem] h-[40rem] bg-tdkop-primary/15 rounded-full mix-blend-multiply filter blur-[100px] animate-[pulse_6s_ease-in-out_infinite]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[35rem] h-[35rem] bg-blue-400/20 rounded-full mix-blend-multiply filter blur-[90px] animate-[pulse_8s_ease-in-out_infinite]" style="animation-delay: 2s;"></div>
        <div class="absolute top-[20%] right-[10%] w-[25rem] h-[25rem] bg-cyan-300/20 rounded-full mix-blend-multiply filter blur-[80px] animate-[pulse_7s_ease-in-out_infinite]" style="animation-delay: 4s;"></div>

        
        <div class="relative z-10 w-full max-w-lg bg-white/70 backdrop-blur-2xl p-8 sm:p-10 rounded-[2rem] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-white/60">
            
            
            <div class="mb-8">
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-sm border border-white/80 text-xs font-bold text-slate-500 hover:bg-tdkop-primary hover:text-white hover:border-tdkop-primary transition-all duration-300 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="transition-transform group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Kembali ke Login
                </a>
            </div>

            
            <div class="text-center mb-8">
                
                <div class="relative inline-flex items-center justify-center w-20 h-20 mb-5 group cursor-default">
                    <div class="absolute inset-0 bg-tdkop-primary/10 rounded-full scale-100 transition-transform duration-500 group-hover:scale-125"></div>
                    <div class="absolute inset-2 bg-gradient-to-tr from-tdkop-primary/20 to-blue-300/30 rounded-full scale-100 transition-transform duration-500 delay-75 group-hover:scale-110"></div>
                    
                    <div class="relative z-10 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full shadow-md flex items-center justify-center text-tdkop-primary border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z"/><path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"/></svg>
                    </div>
                </div>

                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-3">Lupa Sandi?</h1>
                <p class="text-sm text-slate-600 leading-relaxed px-4">
                    Jangan panik! Masukkan alamat email yang tercantum di akun TDKop kamu, dan kami akan mengirimkan notifikasi melalui kotak gmail kamu.
                </p>
            </div>

            
            @if (session('status'))
            <div class="animate-fade-in flex items-start gap-3 bg-emerald-50/80 backdrop-blur-sm text-emerald-700 p-4 rounded-2xl mb-6 text-sm font-medium border border-emerald-200/60 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="shrink-0 mt-0.5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                <p class="leading-relaxed">{{ session('status') }}</p>
            </div>
            @endif

            
            @if ($errors->any())
            <div class="animate-fade-in flex items-start gap-3 bg-red-50/80 backdrop-blur-sm text-red-600 p-4 rounded-2xl mb-6 text-sm font-medium border border-red-200/60 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="shrink-0 mt-0.5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                <p class="leading-relaxed">{{ $errors->first() }}</p>
            </div>
            @endif

            
            <form action="{{ route('password.email') }}" method="POST" class="space-y-6 relative z-20">
                @csrf
                
                
                <div class="relative group/input">
                    
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-tdkop-primary transition-colors z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>

                    
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                        class="peer block w-full pl-11 pr-4 pb-2.5 pt-6 text-sm text-slate-900 bg-white/60 backdrop-blur-md rounded-2xl border-2 border-white/80 appearance-none focus:outline-none focus:ring-0 focus:border-tdkop-primary focus:bg-white transition-all shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] hover:bg-white/80" placeholder=" " />
                    
                    
                    <label for="email" class="absolute text-sm text-slate-500 duration-300 transform -translate-y-2.5 scale-75 top-4 z-10 origin-[0] left-11 peer-focus:text-tdkop-primary peer-focus:font-bold peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:font-normal peer-focus:scale-75 peer-focus:-translate-y-2.5 cursor-text">
                        Alamat Email TDKop
                    </label>
                </div>

                
                <button type="submit" class="group relative w-full flex justify-center items-center gap-2 bg-gradient-to-r from-tdkop-primary to-blue-600 text-white font-bold py-3.5 rounded-2xl text-sm transition-all overflow-hidden shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 active:translate-y-0 border border-white/20">
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="relative z-10">Kirim Tautan Pemulihan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" class="relative z-10 transition-transform duration-300 group-hover:translate-x-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </form>
<div class="mt-8 text-center">
    <p class="text-xs text-slate-500">
        Masih kesulitan mengakses akun? <br class="sm:hidden" />
        <a href="https://wa.me/qr/JMGSZHWLQSDZO1" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="font-bold text-slate-700 hover:text-tdkop-primary hover:underline transition-colors">
            Hubungi Administrator
        </a>
    </p>
</div>

</div>
</div>

    
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