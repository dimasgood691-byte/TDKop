<x-layouts.app title="Daftar Siswa TDKop">
    <div class="min-h-screen flex items-center justify-center bg-slate-50 p-4 py-12">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8 border border-slate-100" data-aos="fade-up">
            <h1 class="text-2xl font-bold text-tdkop-navy mb-6 text-center">Registrasi Siswa</h1>

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm">
                <ul>@foreach ($errors->all() as $error) <li>• {{ $error }}</li> @endforeach</ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                    <input type="text" name="nis" placeholder="NIS" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="class" placeholder="Kelas (e.g. XII RPL 1)" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                    <input type="text" name="major" placeholder="Jurusan" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                </div>
                <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                <input type="email" name="email" placeholder="Email Sekolah" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg">

                <button type="submit" class="w-full bg-tdkop-accent text-white py-3 rounded-lg font-semibold hover:bg-sky-600 transition shadow-md">
                    Buat Akun
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>