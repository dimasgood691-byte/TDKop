<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TDKop - Koperasi SMKN 8 Jakarta' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('tdkop_logo_tab.png') }}">

    <!-- Google Fonts Preconnect & Stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN Fallback & Extended Theme -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Plus Jakarta Sans', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        tdkop: {
                            navy: '#0F172A',
                            primary: '#1E40AF',
                            accent: '#0EA5E9',
                            gold: '#F59E0B',
                            light: '#F8FAFC',
                            bg: '#F8FAFC'
                        }
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(15, 23, 42, 0.08)',
                        'glow-primary': '0 0 25px -5px rgba(30, 64, 175, 0.35)',
                        'glow-accent': '0 0 25px -5px rgba(14, 165, 233, 0.35)',
                    }
                }
            }
        }
    </script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased font-sans min-h-screen selection:bg-sky-500 selection:text-white"
      x-data="{ showScrollTop: false }"
      @scroll.window="showScrollTop = (window.pageYOffset > 400)">

    {{ $slot ?? $content }}

    <!-- Floating Back to Top Button -->
    <button x-show="showScrollTop"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-75"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-75"
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-6 right-6 z-40 p-3.5 rounded-2xl bg-gradient-to-tr from-tdkop-navy to-tdkop-primary text-white shadow-xl shadow-blue-900/30 hover:shadow-2xl hover:shadow-blue-600/40 hover:-translate-y-1 active:scale-95 transition-all duration-300 cursor-pointer border border-white/20"
            title="Kembali ke atas"
            aria-label="Kembali ke atas"
            style="display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 700,
                    once: true,
                    easing: 'ease-out-cubic'
                });
            }
        });
    </script>
</body>

</html>