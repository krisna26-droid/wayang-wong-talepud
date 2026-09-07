<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Dewa Kocala Raqta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-serif-celtic { font-family: 'Cinzel', Georgia, serif; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F7F4] text-[#1E1E1E] antialiased flex flex-col min-h-screen">

    <div class="lg:hidden bg-[#F8F7F4] border-b border-[#EAE6DF] px-4 py-3 flex items-center justify-between sticky top-0 z-40">
        <div>
            <h1 class="font-serif-celtic text-lg font-bold text-[#5A0E0E] leading-tight">Dewa Kocala</h1>
            <span class="text-[8px] font-semibold tracking-[0.2em] text-[#8B6B3E] uppercase block">MANAGEMENT SYSTEM</span>
        </div>
        <button type="button" id="sidebarToggle" class="p-2 text-[#5A0E0E] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div id="sidebarBackdrop" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden transition-opacity"></div>

    <div class="flex flex-1 relative">
        <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#F8F7F4] border-r border-[#EAE6DF] flex flex-col justify-between shrink-0 transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out min-h-screen">
            <div>
                <div class="p-6 md:p-8 pb-4 flex items-center justify-between">
                    <div>
                        <h1 class="font-serif-celtic text-2xl font-bold text-[#5A0E0E] leading-tight">Dewa Kocala</h1>
                        <span class="text-[9px] font-semibold tracking-[0.25em] text-[#8B6B3E] uppercase block mt-0.5">MANAGEMENT SYSTEM</span>
                    </div>
                    <button type="button" id="sidebarClose" class="lg:hidden text-[#7A7770] hover:text-[#5A0E0E] p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="space-y-0.5 mt-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 lg:px-8 py-3.5 text-xs font-bold tracking-wider uppercase transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#5A0E0E] text-white' : 'text-[#4A4A4A] hover:bg-[#EAE6DF]/60' }}">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" stroke-width="2"/>
                            <rect x="14" y="3" width="7" height="7" stroke-width="2"/>
                            <rect x="14" y="14" width="7" height="7" stroke-width="2"/>
                            <rect x="3" y="14" width="7" height="7" stroke-width="2"/>
                        </svg>
                        DASHBOARD
                    </a>

                    <a href="{{ route('admin.arsip.index') }}" class="flex items-center px-6 lg:px-8 py-3.5 text-xs font-bold tracking-wider uppercase transition-colors {{ request()->routeIs('admin.arsip.*') ? 'bg-[#5A0E0E] text-white' : 'text-[#4A4A4A] hover:bg-[#EAE6DF]/60' }}">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        ARCHIVE
                    </a>

                    <a href="{{ route('admin.topeng.index') }}" class="flex items-center px-6 lg:px-8 py-3.5 text-xs font-bold tracking-wider uppercase transition-colors {{ request()->routeIs('admin.topeng.*') ? 'bg-[#5A0E0E] text-white' : 'text-[#4A4A4A] hover:bg-[#EAE6DF]/60' }}">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        MASKS
                    </a>

                    <a href="{{ route('admin.karakter.index') }}" class="flex items-center px-6 lg:px-8 py-3.5 text-xs font-bold tracking-wider uppercase transition-colors {{ request()->routeIs('admin.karakter.*') ? 'bg-[#5A0E0E] text-white' : 'text-[#4A4A4A] hover:bg-[#EAE6DF]/60' }}">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        CHARACTERS
                    </a>

                    <a href="{{ route('admin.pemeran.index') }}" class="flex items-center px-6 lg:px-8 py-3.5 text-xs font-bold tracking-wider uppercase transition-colors {{ request()->routeIs('admin.pemeran.*') ? 'bg-[#5A0E0E] text-white' : 'text-[#4A4A4A] hover:bg-[#EAE6DF]/60' }}">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        PERFORMERS
                    </a>
                </nav>
            </div>

            <div class="p-6">
                @if(request()->routeIs('admin.karakter.*'))
                    <a href="{{ route('admin.karakter.create') }}" class="block w-full py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-center text-xs font-bold tracking-wider uppercase transition-colors mb-5">
                        + TAMBAH KARAKTER
                    </a>
                @elseif(request()->routeIs('admin.topeng.*'))
                    <a href="{{ route('admin.topeng.create') }}" class="block w-full py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-center text-xs font-bold tracking-wider uppercase transition-colors mb-5">
                        + TAMBAH TOPENG
                    </a>
                @elseif(request()->routeIs('admin.arsip.*'))
                    <a href="{{ route('admin.arsip.create') }}" class="block w-full py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-center text-xs font-bold tracking-wider uppercase transition-colors mb-5">
                        + TAMBAH ARSIP
                    </a>
                @elseif(request()->routeIs('admin.pemeran.*'))
                    <a href="{{ route('admin.pemeran.create') }}" class="block w-full py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-center text-xs font-bold tracking-wider uppercase transition-colors mb-5">
                        + TAMBAH PEMERAN
                    </a>
                @else
                    <a href="{{ route('admin.topeng.create') }}" class="block w-full py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-center text-xs font-bold tracking-wider uppercase transition-colors mb-5">
                        + NEW ENTRY
                    </a>
                @endif

                <div class="flex items-center justify-between pt-4 border-t border-[#EAE6DF]">
                    <div class="flex items-center space-x-3 min-w-0">
                        <div class="w-9 h-9 rounded-full bg-[#5A0E0E] text-white flex items-center justify-center font-bold text-xs shrink-0">
                            {{ strtoupper(substr(Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'AD', 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-[#1E1E1E] leading-tight uppercase truncate">
                                {{ Auth::user()->role ?? 'ADMIN' }}
                            </p>
                            <p class="text-[10px] text-[#8A8477] truncate">
                                {{ Auth::user()->nama_lengkap ?? Auth::user()->name ?? Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="shrink-0 ml-2">
                        @csrf
                        <button type="submit" title="Keluar" class="text-[#8A8477] hover:text-[#5A0E0E] p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 bg-[#F8F7F4]">
            @hasSection('header_title')
                <header class="h-16 lg:h-20 px-4 sm:px-8 lg:px-12 border-b border-[#EAE6DF] flex items-center justify-between">
                    <div>
                        <h2 class="font-serif-celtic text-xl sm:text-2xl font-bold text-[#1E1E1E]">@yield('header_title')</h2>
                        <span class="text-[8px] sm:text-[9px] font-semibold tracking-widest text-[#8A8A8A] uppercase">@yield('header_subtitle')</span>
                    </div>
                    <div class="flex items-center space-x-4 sm:space-x-6 text-xs text-[#555]">
                        <div class="hidden sm:flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#8A8A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                            <span>{{ now()->locale('id')->isoFormat('D MMMM Y') }}</span>
                        </div>
                    </div>
                </header>
            @endif

            <div class="px-4 sm:px-8 lg:px-12 py-6 sm:py-8 lg:py-10 flex-1">
                @yield('content')
            </div>
        </main>
    </div>

    <footer class="py-6 sm:py-8 px-4 sm:px-8 lg:px-12 bg-[#F8F7F4] flex flex-col md:flex-row items-center justify-between gap-4 border-t border-[#EAE6DF] text-xs text-[#7A7770]">
        <div class="flex flex-col items-center md:items-start space-y-1 text-center md:text-left">
            <span class="font-serif-celtic font-bold text-base sm:text-lg text-[#5A0E0E]">DEWA KOCALA</span>
            <p class="text-[10px] sm:text-[11px]">© 2026 Wayang Wong Dewa Kocala Raqta Talepud. Archival Excellence.</p>
        </div>
        <div class="flex flex-wrap justify-center space-x-4 sm:space-x-6 text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider text-[#555]">
            <a href="#" class="hover:text-[#5A0E0E]">Academic Credentials</a>
            <a href="#" class="hover:text-[#5A0E0E]">Privacy Policy</a>
            <a href="#" class="hover:text-[#5A0E0E]">Institutional Access</a>
        </div>
    </footer>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        }

        if (sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
        if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);
    </script>
</body>
</html>