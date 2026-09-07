<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Arsip Digital Budaya') - Dewa Kocala Raqta Talepud</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-serif-celtic { font-family: 'Cinzel', Georgia, serif; }
        .font-serif-quote { font-family: 'Playfair Display', Georgia, serif; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FCFBFA] text-[#1E1E1E] antialiased flex flex-col min-h-screen">

    <!-- Navigasi Publik Bersih -->
    <header class="w-full bg-[#FCFBFA] border-b border-[#EFECE6] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-serif-celtic text-lg sm:text-xl font-bold tracking-wider text-[#5A0E0E]">
                DEWA KOCALA RAQTA TALEPUD
            </a>

            <nav class="hidden md:flex items-center space-x-8 text-[11px] font-bold tracking-[0.18em] uppercase text-[#4A4A4A]">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#5A0E0E] underline underline-offset-8 decoration-2' : 'hover:text-[#5A0E0E] transition-colors' }}">
                    BERANDA
                </a>
                <a href="{{ route('arsip.index') }}" class="{{ request()->routeIs('arsip.*') ? 'text-[#5A0E0E] underline underline-offset-8 decoration-2' : 'hover:text-[#5A0E0E] transition-colors' }}">
                    ARSIP
                </a>
                <a href="{{ route('topeng.index') }}" class="{{ request()->routeIs('topeng.*') ? 'text-[#5A0E0E] underline underline-offset-8 decoration-2' : 'hover:text-[#5A0E0E] transition-colors' }}">
                    TOPENG
                </a>
                <a href="{{ route('karakter.index') }}" class="{{ request()->routeIs('karakter.*') ? 'text-[#5A0E0E] underline underline-offset-8 decoration-2' : 'hover:text-[#5A0E0E] transition-colors' }}">
                    KARAKTER
                </a>
                <a href="{{ route('pemeran.index') }}" class="{{ request()->routeIs('pemeran.*') ? 'text-[#5A0E0E] underline underline-offset-8 decoration-2' : 'hover:text-[#5A0E0E] transition-colors' }}">
                    PEMERAN
                </a>
            </nav>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer Publik -->
    <footer class="w-full bg-[#EAE6DF] pb-16 pt-10 text-center border-t border-[#DCD5C6]">
        <div class="w-16 h-px bg-[#C9BFB0] mx-auto mb-6"></div>
        <h4 class="font-serif-celtic text-xl sm:text-2xl font-bold text-[#5A0E0E] tracking-wider">
            WAYANG WONG DEWA KOCALA
        </h4>
        <p class="mt-3 text-[10px] sm:text-[11px] text-[#7A7468]">
            &copy; 2026 Wayang Wong Dewa Kocala Raqta Talepud. Archival Excellence. Melestarikan Budaya Melalui Inovasi Digital.
        </p>
    </footer>

</body>
</html>