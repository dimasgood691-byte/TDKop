<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TDKop - Koperasi SMKN 8 Jakarta' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('tdkop_logo_tab.png') }}">

    <!-- 1. Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 2. Tailwind Custom Config (Warna TDKop) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        tdkop: {
                            primary: '#1E3A8A', // Deep Blue
                            navy: '#0F172A',
                            accent: '#0284C7', // Sky Blue
                            light: '#F8FAFC'
                        }
                    }
                }
            }
        }
    </script>

    <!-- 3. AOS Animation CSS & JS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- 4. Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- 5. Local application bundle, including Chart.js -->
    @vite('resources/js/app.js')
</head>

<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    {{ $slot ?? $content }}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true
            });
        });
    </script>
</body>

</html>