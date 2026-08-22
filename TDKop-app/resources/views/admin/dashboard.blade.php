<x-layouts.app title="Dashboard Pembina Koperasi - TDKop">
    <!-- Navbar Admin -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/80 shadow-xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand & User Profile Info -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="bg-gradient-to-tr from-sky-500 via-blue-600 to-indigo-900 text-white px-3.5 py-1.5 rounded-xl font-black text-xl tracking-wider shadow-md shadow-blue-500/20 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                    TDKop
                </a>
                <div>
                    <h1 class="font-extrabold text-slate-900 text-sm sm:text-base leading-tight">Dashboard Pembina Koperasi</h1>
                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
                        {{ auth()->user()->name }}
                        <span class="bg-sky-100 text-sky-800 font-bold px-2 py-0.5 rounded-md text-[10px] uppercase tracking-wider ml-1">
                            {{ auth()->user()->role }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Logout Action -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-rose-500 bg-slate-100/50 hover:bg-rose-50 p-2 rounded-full transition-colors" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
        x-data="{ activeTab: 'orders', createModal: false, zoomImage: null }">

        <!-- Alerts -->
        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 mb-6 text-sm font-semibold flex items-center gap-3 shadow-sm">
            <span class="bg-emerald-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">✓</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 text-red-800 p-4 rounded-2xl border border-red-200 mb-6 text-sm font-semibold shadow-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- HERO BANNER -->
        <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10">
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight mb-2">
                    Halo, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-2xl leading-relaxed">
                    Kelola pesanan siswa, pantau grafik penjualan, pantau stok barang, dan perbarui katalog produk Koperasi SMK 8 dengan cepat dan praktis dari website ini.
                </p>
            </div>
        </div>

        <!-- SUMMARY STATS CARDS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Total Pesanan</span>
                    <span class="text-2xl sm:text-3xl font-black text-slate-800">{{ $totalOrders }}</span>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Perlu Diproses</span>
                    <span class="text-2xl sm:text-3xl font-black text-amber-500">{{ $pendingOrders }}</span>
                </div>
                <div class="p-3 bg-amber-50 text-amber-500 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Pendapatan</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Jenis Produk</span>
                    <span class="text-2xl sm:text-3xl font-black text-indigo-600">{{ $totalProducts }}</span>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- PILL TAB CONTROLS -->
        <div class="bg-slate-100/80 p-1.5 rounded-2xl inline-flex gap-2 mb-8 border border-slate-200/50">
            <button @click="activeTab = 'orders'"
                :class="activeTab === 'orders' ? 'bg-indigo-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                Pesanan Siswa
            </button>
            <button @click="activeTab = 'sales'"
                :class="activeTab === 'sales' ? 'bg-indigo-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                Grafik Penjualan
            </button>
            <button @click="activeTab = 'stocks'"
                :class="activeTab === 'stocks' ? 'bg-indigo-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                Manajemen Produk & Stok
            </button>
        </div>

        <!-- TAB 0: GRAFIK PENJUALAN -->
        <section x-show="activeTab === 'sales'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
            <!-- HEADER & FILTER -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 bg-sky-50 border border-sky-200/80 px-3 py-1 rounded-full mb-2">
                        <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                        <h2 class="text-[11px] font-black uppercase tracking-[0.18em] text-sky-700">Grafik Penjualan Koperasi</h2>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Penjualan resmi berdasarkan pesanan yang sudah selesai dikonfirmasi.</p>
                </div>
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3 bg-white/80 backdrop-blur-md p-3.5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-slate-300 transition-all">
                    <label class="text-[10px] font-black uppercase tracking-wider text-slate-400">
                        Dari
                        <input type="date" name="date_from" value="{{ $dateFrom->toDateString() }}" class="block mt-1 px-3 py-2 rounded-xl border border-slate-200 text-xs font-extrabold text-slate-800 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 outline-none transition cursor-pointer">
                    </label>
                    <label class="text-[10px] font-black uppercase tracking-wider text-slate-400">
                        Sampai
                        <input type="date" name="date_to" value="{{ $dateTo->toDateString() }}" class="block mt-1 px-3 py-2 rounded-xl border border-slate-200 text-xs font-extrabold text-slate-800 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 outline-none transition cursor-pointer">
                    </label>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-900 hover:bg-slate-900 text-white text-xs font-extrabold shadow-sm hover:shadow-md active:scale-95 transition-all cursor-pointer shrink-0">Terapkan</button>
                </form>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5 mb-8">
                <div class="bg-white rounded-2xl border border-emerald-100/80 p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600/80 group-hover:text-emerald-700">Pendapatan</span>
                    <p class="text-xl sm:text-2xl font-black text-emerald-600 mt-2 tracking-tight">Rp {{ number_format($salesSummary['revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-sky-100/80 p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <span class="text-[10px] font-black uppercase tracking-wider text-sky-600/80 group-hover:text-sky-700">Produk Terjual</span>
                    <p class="text-xl sm:text-2xl font-black text-sky-600 mt-2 tracking-tight">{{ number_format($salesSummary['units']) }} pcs</p>
                </div>
                <div class="bg-white rounded-2xl border border-indigo-100/80 p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600/80 group-hover:text-indigo-700">Pesanan Selesai</span>
                    <p class="text-xl sm:text-2xl font-black text-indigo-600 mt-2 tracking-tight">{{ number_format($salesSummary['orders']) }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-amber-100/80 p-5 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <span class="text-[10px] font-black uppercase tracking-wider text-amber-600/80 group-hover:text-amber-700">Rata-rata Pesanan</span>
                    <p class="text-xl sm:text-2xl font-black text-amber-600 mt-2 tracking-tight">Rp {{ number_format($salesSummary['average_order'], 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- CHARTS SECTION -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
                <!-- LINE CHART -->
                <div class="xl:col-span-2 bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-extrabold text-slate-900 text-base">Grafik Penjualan</h3>
                            <p class="text-xs text-slate-400 font-medium mt-0.5">Pendapatan dan unit terakumulasi per hari</p>
                        </div>
                        <span class="text-[10px] font-black text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-3 py-1 rounded-full uppercase tracking-wider">SELESAI</span>
                    </div>
                    @php
                    $chartDays = $dailySales->values();
                    $chartMaxRevenue = max(1, $chartDays->max('revenue'));
                    $chartMaxUnits = max(1, $chartDays->max('units'));
                    $chartLastIndex = max(1, $chartDays->count() - 1);
                    @endphp
                    <div class="h-72 overflow-hidden w-full">
                        <svg viewBox="0 0 800 280" class="w-full h-full" role="img" aria-label="Grafik garis penjualan harian">
                            <!-- Subtle Grid Lines -->
                            <line x1="48" y1="28" x2="48" y2="238" stroke="#e2e8f0" stroke-width="1.5" />
                            <line x1="48" y1="238" x2="780" y2="238" stroke="#e2e8f0" stroke-width="1.5" />
                            <line x1="48" y1="78" x2="780" y2="78" stroke="#f1f5f9" stroke-dasharray="4 4" />
                            <line x1="48" y1="128" x2="780" y2="128" stroke="#f1f5f9" stroke-dasharray="4 4" />
                            <line x1="48" y1="188" x2="780" y2="188" stroke="#f1f5f9" stroke-dasharray="4 4" />
                            <text x="8" y="34" fill="#94a3b8" font-size="11" font-weight="700">Rp {{ number_format($chartMaxRevenue, 0, ',', '.') }}</text>
                            <text x="18" y="242" fill="#94a3b8" font-size="11" font-weight="700">Rp 0</text>

                            <!-- Chart Line -->
                            <polyline
                                fill="none"
                                stroke="#10b981"
                                stroke-width="3.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                points="@foreach($chartDays as $index => $day){{ 48 + ($index / $chartLastIndex * 732) }},{{ 238 - ($day['revenue'] / $chartMaxRevenue * 190) }} @endforeach" />

                            @foreach($chartDays as $index => $day)
                            @if($day['revenue'] > 0)
                            <circle cx="{{ 48 + ($index / $chartLastIndex * 732) }}" cy="{{ 238 - ($day['revenue'] / $chartMaxRevenue * 190) }}" r="5" fill="#ffffff" stroke="#10b981" stroke-width="3.5" class="transition-transform hover:scale-125">
                                <title>{{ $day['label'] }}: Rp {{ number_format($day['revenue'], 0, ',', '.') }}</title>
                            </circle>
                            @endif
                            @if($index === 0 || $index === (int) floor($chartDays->count() / 2) || $index === $chartDays->count() - 1)
                            <text x="{{ 48 + ($index / $chartLastIndex * 732) }}" y="264" text-anchor="middle" fill="#64748b" font-size="11" font-weight="600">{{ $day['label'] }}</text>
                            @endif
                            @endforeach
                        </svg>
                    </div>
                </div>

                <!-- DONUT CHART -->
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">Penjualan Berdasarkan Gender</h3>
                        <p class="text-xs text-slate-400 font-medium mt-0.5 mb-4">Jumlah unit dari kategori pakaian/seragam</p>
                    </div>
                    @php
                    $genderTotal = $genderSales->sum();
                    $genderCircle = 389;
                    $genderOffset = 0;
                    $genderColors = ['Laki-laki' => '#0284c7', 'Perempuan' => '#ec4899', 'Umum' => '#94a3b8'];
                    @endphp
                    <div class="relative h-56 flex items-center justify-center my-2">
                        <svg viewBox="0 0 180 180" class="w-48 h-48 -rotate-90 drop-shadow-xs" role="img" aria-label="Diagram penjualan berdasarkan gender">
                            <circle cx="90" cy="90" r="62" fill="none" stroke="#f1f5f9" stroke-width="18" />
                            @if($genderTotal > 0)
                            @foreach($genderSales as $gender => $units)
                            @php
                            $genderDash = $genderCircle * ($units / $genderTotal);
                            $genderColor = $genderColors[$gender] ?? '#64748b';
                            @endphp
                            <circle cx="90" cy="90" r="62" fill="none" stroke="{{ $genderColor }}" stroke-width="18" stroke-linecap="butt" stroke-dasharray="{{ $genderDash }} {{ $genderCircle - $genderDash }}" stroke-dashoffset="-{{ $genderOffset }}" class="transition-all hover:opacity-90">
                                <title>{{ $gender }}: {{ number_format($units) }} pcs</title>
                            </circle>
                            @php $genderOffset += $genderDash; @endphp
                            @endforeach
                            @endif
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($genderTotal) }}</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Pcs</span>
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-1 gap-2">
                        @forelse($genderSales as $gender => $units)
                        @php $genderColor = $genderColors[$gender] ?? '#64748b'; @endphp
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50/80 px-3.5 py-2.5 text-xs border border-slate-100 hover:border-slate-200 transition-colors">
                            <span class="flex items-center gap-2 font-extrabold text-slate-700">
                                <span class="h-2.5 w-2.5 rounded-full {{ $gender === 'Laki-laki' ? 'bg-sky-500 shadow-xs shadow-sky-500/50' : ($gender === 'Perempuan' ? 'bg-pink-500 shadow-xs shadow-pink-500/50' : 'bg-slate-400') }}"></span>
                                {{ $gender }}
                            </span>
                            <span class="font-black text-slate-900">{{ number_format($units) }} <span class="text-[10px] text-slate-400 font-bold">pcs</span></span>
                        </div>
                        @empty
                        <div class="rounded-2xl bg-slate-50/80 px-3 py-3 text-center text-xs text-slate-400 font-medium">Belum ada penjualan selesai.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- TOP PRODUCTS TABLE -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-extrabold text-slate-900 text-base">Produk Terlaris</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Diurutkan berdasarkan jumlah akumulasi unit terjual</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead class="bg-slate-50/80 text-[10px] uppercase tracking-wider text-slate-500 font-black border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-3.5">Produk</th>
                                <th class="px-6 py-3.5">Unit</th>
                                <th class="px-6 py-3.5">Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($topProducts as $product)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4 font-extrabold text-slate-800">{{ $product['name'] }}</td>
                                <td class="px-6 py-4 font-black text-sky-600">{{ number_format($product['units']) }} <span class="text-[10px] text-sky-500/70 font-extrabold">pcs</span></td>
                                <td class="px-6 py-4 font-black text-emerald-600">Rp {{ number_format($product['revenue'], 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-slate-400 font-medium">Belum ada penjualan selesai pada periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- TAB 1: KELOLA PESANAN -->
        <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white rounded-3xl border border-slate-300/80 shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead class="bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-900 text-slate-100 uppercase tracking-wider text-[11px] font-bold">
                            <tr class="divide-x divide-slate-700/60">
                                <th class="p-4 sm:px-6">No. Transaksi</th>
                                <th class="p-4">Pemesan</th>
                                <th class="p-4">Detail Barang</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi Status</th>
                                <th class="p-4 sm:px-6 text-center">Struk</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($orders as $order)
                            <tr class="hover:bg-blue-50/50 even:bg-slate-50/70 transition-colors divide-x divide-slate-200/80">
                                <td class="p-4 sm:px-6 font-mono font-extrabold text-blue-950">{{ $order->order_number }}</td>
                                <td class="p-4">
                                    <div class="font-extrabold text-slate-900">{{ $order->user->name }}</div>
                                    <div class="text-[11px] text-slate-500 font-semibold mt-0.5">{{ $order->user->class ?? 'Siswa' }} • NIS: {{ $order->user->nis ?? '-' }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="space-y-1">
                                        @foreach($order->details as $detail)
                                        <div class="text-slate-700 font-medium">
                                            <span class="text-slate-400">•</span>
                                            <span class="font-bold text-slate-900">{{ $detail->product->name }}</span>
                                            <span class="text-xs text-slate-500">{{ $detail->size->display_name ?? 'Ukuran tidak tersedia' }}</span>
                                            <span class="font-bold text-slate-900">x{{ $detail->quantity }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if($order->notes)
                                    <div class="text-[11px] text-slate-500 italic mt-1.5 bg-amber-50/80 p-2 rounded-lg border border-amber-200/70 text-amber-900">
                                        <span class="font-bold not-italic">Catatan:</span> {{ $order->notes }}
                                    </div>
                                    @endif
                                </td>
                                <td class="p-4 font-black text-emerald-700 text-sm">Rp {{ number_format($order->total_price ?? $order->total_amount, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider inline-block shadow-2xs
                                            @if($order->status === 'pending') bg-amber-100 text-amber-800 border border-amber-300
                                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800 border border-blue-300
                                            @elseif($order->status === 'ready') bg-purple-100 text-purple-800 border border-purple-300
                                            @elseif($order->status === 'completed') bg-emerald-100 text-emerald-800 border border-emerald-300
                                            @else bg-rose-100 text-rose-800 border border-rose-300 @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 text-xs border border-slate-300 rounded-xl bg-white hover:bg-slate-50 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer font-bold text-slate-800 transition shadow-2xs">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-4 sm:px-6 text-center">
                                    <a href="{{ route('order.receipt', $order->id) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-slate-800 hover:bg-slate-900 text-white px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs">
                                        Cetak Struk
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-12 text-center text-slate-400 font-semibold">Belum ada transaksi siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 2: KELOLA STOK & KATALOG -->
        <div x-show="activeTab === 'stocks'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-98"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            style="display: none;">

            <!-- HEADER SECTION -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 bg-white/60 backdrop-blur-md p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </span>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight">Manajemen Produk & Stok</h2>
                    </div>
                    <p class="text-xs font-semibold text-slate-400 pl-9">Atur ketersediaan barang dan pembaruan katalog koperasi.</p>
                </div>

                <!-- BUTTON TAMBAH PRODUK -->
                <button @click="createModal = true"
                    class="relative group overflow-hidden bg-gradient-to-r from-indigo-900 via-indigo-800 to-slate-900 text-white font-bold text-xs sm:text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-indigo-900/20 hover:shadow-indigo-900/40 hover:-translate-y-0.5 active:translate-y-0 active:scale-95 transition-all duration-200 flex items-center gap-2.5">
                    <span class="absolute inset-0 w-full h-full bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <span class="bg-white/20 p-1 rounded-lg text-white group-hover:rotate-90 transition-transform duration-300">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </span>
                    Tambah Produk Baru
                </button>
            </div>

            <!-- GRID KATALOG BARANG -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                    <div>
                        <!-- Container Gambar Produk -->
                        <div class="h-64 bg-gradient-to-b from-slate-100/80 to-slate-50 relative overflow-hidden flex items-center justify-center p-6 border-b border-slate-100">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                @click="zoomImage = '{{ asset('storage/' . $product->image) }}'"
                                alt="{{ $product->name }}"
                                class="max-h-full w-auto object-contain transition-transform duration-500 group-hover:scale-110 cursor-zoom-in drop-shadow-md">
                            @else
                            <div class="flex flex-col items-center gap-2 text-slate-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-[10px] font-black tracking-widest uppercase">No Image</span>
                            </div>
                            @endif

                            <!-- Badge Kategori -->
                            <span class="absolute top-4 left-4 text-[10px] font-extrabold text-slate-700 uppercase tracking-wider bg-white/80 backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-sm border border-white/60">
                                {{ $product->category->name }}
                            </span>

                            <!-- Form Hapus Quick Action -->
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="absolute top-4 right-4 z-10">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white/80 hover:bg-rose-500 hover:text-white text-rose-500 p-2.5 rounded-2xl shadow-sm hover:shadow-rose-500/30 backdrop-blur-md transition-all duration-200 active:scale-90" title="Hapus Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Info & Form Produk -->
                        <div class="p-6 space-y-5">
                            <div>
                                <h3 class="font-extrabold text-slate-900 text-base line-clamp-1 group-hover:text-indigo-900 transition-colors" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </h3>
                            </div>

                            <!-- RINGKASAN STOK PER GENDER (LAKI-LAKI & PEREMPUAN) -->
                            <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100 text-xs">
                                <!-- Stok Laki-Laki -->
                                <div class="bg-sky-50 border border-sky-100 rounded-xl p-2 flex flex-col items-center">
                                    <span class="text-[10px] font-black text-sky-600 uppercase">Laki-Laki</span>
                                    <span class="font-extrabold text-sky-900 text-sm">
                                        {{ $product->stocks->filter(fn($s) => strtolower($s->size->gender ?? '') === 'laki-laki')->sum('stock') }} Pcs
                                    </span>
                                </div>

                                <!-- Stok Perempuan -->
                                <div class="bg-pink-50 border border-pink-100 rounded-xl p-2 flex flex-col items-center">
                                    <span class="text-[10px] font-black text-pink-600 uppercase">Perempuan</span>
                                    <span class="font-extrabold text-pink-900 text-sm">
                                        {{ $product->stocks->filter(fn($s) => strtolower($s->size->gender ?? '') === 'perempuan')->sum('stock') }} Pcs
                                    </span>
                                </div>
                            </div>

                            <!-- Form Update Foto -->
                            <form action="{{ route('admin.product.image.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-3 bg-slate-50/80 rounded-2xl border border-slate-100 space-y-2">
                                @csrf
                                @method('PATCH')
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider">Ganti Foto Produk</label>
                                <div class="flex items-center gap-2">
                                    <input type="file" name="image" accept="image/*" required class="w-full text-[10px] text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-white file:text-slate-700 file:shadow-xs hover:file:bg-slate-200 cursor-pointer">
                                    <button type="submit" class="bg-slate-900 hover:bg-indigo-950 text-white text-[10px] px-3.5 py-1.5 rounded-xl font-bold transition-all shadow-xs active:scale-95 shrink-0">
                                        Upload
                                    </button>
                                </div>
                            </form>

                            <!-- Form Update Harga -->
                            <form action="{{ route('admin.product.price.update', $product->id) }}" method="POST" class="p-3 bg-emerald-50/50 rounded-2xl border border-emerald-100 space-y-2">
                                @csrf
                                @method('PATCH')
                                <label class="block text-[10px] font-black text-emerald-800 uppercase tracking-wider">Harga Satuan</label>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-black text-emerald-700">Rp</span>
                                    <input type="number" name="price" value="{{ (int)$product->price }}" min="0" required class="w-full px-3 py-1.5 border border-emerald-200/80 rounded-xl text-xs font-black text-emerald-900 outline-none focus:ring-2 focus:ring-emerald-500/50 bg-white">
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] px-3.5 py-1.5 rounded-xl font-bold transition-all shadow-sm shadow-emerald-600/20 active:scale-95 shrink-0">
                                        Simpan
                                    </button>
                                </div>
                            </form>

                            <!-- Update Stok Ukuran Berdasarkan Kategori & Gender -->
                            <div class="space-y-3" x-data="{ 
                                    genderTab: 'laki-laki', 
                                    isSeragam: '{{ strtolower($product->category->name ?? '') }}'.includes('seragam') 
                                }">
                                <div class="flex items-center justify-between">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                        Manajemen Stok Ukuran
                                    </label>

                                    <!-- Switcher Gender (HANYA MUNCUL JIKA KATEGORI MEMUAT KATA 'SERAGAM') -->
                                    <template x-if="isSeragam">
                                        <div class="flex gap-1 bg-slate-100 p-0.5 rounded-xl border border-slate-200/60">
                                            <button type="button" @click="genderTab = 'laki-laki'"
                                                :class="genderTab === 'laki-laki' ? 'bg-sky-500 text-white shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                                                class="px-2 py-0.5 text-[10px] font-extrabold rounded-lg transition-all">
                                                Laki-Laki
                                            </button>
                                            <button type="button" @click="genderTab = 'perempuan'"
                                                :class="genderTab === 'perempuan' ? 'bg-pink-500 text-white shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                                                class="px-2 py-0.5 text-[10px] font-extrabold rounded-lg transition-all">
                                                Perempuan
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <!-- Daftar Form Update Stok -->
                                <div class="space-y-2 max-h-48 overflow-y-auto pr-1 custom-scrollbar">
                                    @foreach($product->stocks as $stockItem)
                                    @php
                                    $sizeName = strtolower($stockItem->size->name ?? '');
                                    $isStandard = in_array($sizeName, ['standard', 'standar', 'all size', 'umum']);
                                    @endphp

                                    <form action="{{ route('admin.stock.update', $stockItem->id) }}" method="POST"
                                        x-data="{ 
                                            sizeGender: '{{ strtolower($stockItem->size->gender ?? '') }}', 
                                            isStandard: {{ $isStandard ? 'true' : 'false' }} 
                                        }"
                                        x-show="isSeragam ? (!isStandard && sizeGender === genderTab) : isStandard"
                                        class="flex items-center justify-between text-xs bg-slate-50 hover:bg-white p-2.5 rounded-2xl border border-slate-100 hover:border-slate-200 transition-all hover:shadow-xs">
                                        @csrf
                                        @method('PATCH')

                                        <div class="flex items-center gap-1.5 ml-1">
                                            <span class="font-extrabold text-slate-700">{{ $stockItem->size->name }}</span>
                                            @if($stockItem->size->gender === 'laki-laki')
                                            <span class="bg-sky-100 text-sky-700 text-[9px] font-black px-1.5 py-0.2 rounded border border-sky-200">L</span>
                                            @elseif($stockItem->size->gender === 'perempuan')
                                            <span class="bg-pink-100 text-pink-700 text-[9px] font-black px-1.5 py-0.2 rounded border border-pink-200">P</span>
                                            @else
                                            <span class="bg-slate-100 text-slate-600 text-[9px] font-black px-1.5 py-0.2 rounded border border-slate-200">Umum</span>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input type="number" name="stock" value="{{ $stockItem->stock }}" min="0" class="w-14 px-2 py-1 border border-slate-200 rounded-xl text-center outline-none font-black bg-white text-slate-800 focus:ring-2 focus:ring-indigo-500/30">
                                            <button type="submit" class="bg-indigo-900 hover:bg-slate-900 text-white px-3 py-1 rounded-xl font-bold hover:shadow-sm transition-all active:scale-95 text-[10px]">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- MODAL ZOOM GAMBAR (LIGHTBOX) -->
            <div x-show="zoomImage"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-xl flex items-center justify-center p-4 sm:p-6"
                style="display: none;">
                <div @click.away="zoomImage = null" class="relative max-w-4xl max-h-[90vh] bg-white/10 rounded-3xl p-3 shadow-2xl border border-white/20 overflow-hidden flex items-center justify-center">
                    <button @click="zoomImage = null" class="absolute top-4 right-4 text-slate-800 hover:text-rose-500 bg-white/90 hover:bg-white backdrop-blur-md rounded-full p-2.5 font-black transition shadow-lg active:scale-90 z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <img :src="zoomImage" class="max-h-[85vh] w-auto object-contain rounded-2xl shadow-2xl">
                </div>
            </div>

            <!-- MODAL TAMBAH PRODUK -->
            <div x-show="createModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 backdrop-blur-0"
                x-transition:enter-end="opacity-100 backdrop-blur-sm"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 backdrop-blur-sm"
                x-transition:leave-end="opacity-0 backdrop-blur-0"
                class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4"
                style="display: none;">

                <div @click.away="createModal = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto border border-slate-100">

                    <button @click="createModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-rose-500 font-bold bg-slate-100 hover:bg-rose-50 w-8 h-8 rounded-full flex items-center justify-center transition active:scale-90">✕</button>

                    <div class="mb-6">
                        <h3 class="text-xl font-black text-slate-900">+ Tambah Produk Baru</h3>
                        <p class="text-xs text-slate-400 font-medium mt-1">Lengkapi data produk untuk menambah ke katalog koperasi.</p>
                    </div>

                    <form x-data="{ selectedCatName: '', modalGenderTab: 'laki-laki' }" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 mb-1.5">Kategori Barang</label>
                            <select name="category_id"
                                @change="selectedCatName = $event.target.options[$event.target.selectedIndex].text.toLowerCase()"
                                required
                                class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-slate-50/50 transition">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 mb-1.5">Nama Barang</label>
                            <input type="text" name="name" required placeholder="Contoh: Seragam Batik SMK 8" class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-slate-50/50 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 mb-1.5">Harga Satuan (Rp)</label>
                            <input type="number" name="price" required min="0" placeholder="115000" class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs font-black text-emerald-600 focus:ring-2 focus:ring-emerald-500 outline-none bg-slate-50/50 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 mb-1.5">Deskripsi (Opsional)</label>
                            <textarea name="description" rows="2" placeholder="Bahan katun halus, nyaman..." class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-slate-50/50 transition"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 mb-1.5">Foto Produk</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                        </div>

                        <hr class="my-5 border-slate-100">

                        <!-- Input Stok Awal Berdasarkan Gender -->
                        <div x-show="selectedCatName !== ''" x-transition class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-extrabold text-slate-800">Stok Awal Ukuran:</label>

                                <!-- Toggle Switcher Gender -->
                                <div class="flex gap-1 bg-slate-100 p-1 rounded-xl border border-slate-200 shadow-inner">
                                    <button type="button" @click="modalGenderTab = 'laki-laki'"
                                        :class="modalGenderTab === 'laki-laki' ? 'bg-sky-500 text-white shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                                        class="px-3 py-1 text-[11px] font-extrabold rounded-lg transition-all">
                                        Laki-Laki
                                    </button>
                                    <button type="button" @click="modalGenderTab = 'perempuan'"
                                        :class="modalGenderTab === 'perempuan' ? 'bg-pink-500 text-white shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                                        class="px-3 py-1 text-[11px] font-extrabold rounded-lg transition-all">
                                        Perempuan
                                    </button>
                                </div>
                            </div>

                            <!-- Grid Filter Ukuran Sesuai Gender yang Aktif -->
                            <div class="grid grid-cols-2 gap-2.5 max-h-52 overflow-y-auto pr-1 custom-scrollbar">
                                @foreach($sizes as $size)
                                <div x-data="{ sizeGender: '{{ strtolower($size->gender) }}' }"
                                    x-show="sizeGender === modalGenderTab || sizeGender === 'umum'"
                                    class="flex items-center justify-between bg-slate-50 hover:bg-white p-2.5 rounded-2xl border border-slate-200/80 gap-2 transition">

                                    <div class="min-w-0">
                                        <span class="block text-xs font-black text-slate-700">{{ $size->name }}</span>
                                        <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-wider">{{ $size->gender }}</span>
                                    </div>

                                    <!-- Input Stok Size -->
                                    <input type="number"
                                        name="stocks[{{ $size->id }}]"
                                        min="0"
                                        value="0"
                                        class="w-16 px-2.5 py-1 border border-slate-200 rounded-xl text-xs text-center font-black bg-white text-slate-800 focus:ring-2 focus:ring-indigo-500/30 outline-none">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-6 bg-gradient-to-r from-indigo-900 to-slate-900 hover:from-slate-900 hover:to-indigo-900 text-white py-4 rounded-2xl font-black text-xs shadow-lg shadow-indigo-900/20 transition-all duration-200 active:scale-98">
                            Simpan Produk Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>