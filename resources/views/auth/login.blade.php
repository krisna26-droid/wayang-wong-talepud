<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Sistem - Dewa Kocala Raqta Talepud</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-serif-celtic {
            font-family: 'Cinzel', Georgia, serif;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#F8F7F4] text-[#1E1E1E] min-h-screen flex flex-col justify-between antialiased">
    
    <div class="flex-1 flex items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Sisi Kiri: Branding Teks -->
            <div class="lg:col-span-7 space-y-4">
                <span class="text-xs md:text-sm font-semibold tracking-[0.25em] text-[#8B6B3E] uppercase block">
                    Sistem Manajemen Arsip
                </span>
                <h1 class="font-serif-celtic text-5xl sm:text-6xl md:text-7xl font-bold tracking-tight text-[#5A0E0E] leading-[1.08]">
                    DEWA KOCALA<br>RAQTA TALEPUD
                </h1>
            </div>

            <!-- Sisi Kanan: Kartu Form Login -->
            <div class="lg:col-span-5 bg-[#F4F2EE] p-8 md:p-12 shadow-sm border border-[#E8E4DD]">
                <div class="mb-8">
                    <h2 class="font-serif-celtic text-3xl font-bold text-[#1E1E1E] mb-2">Masuk ke Sistem</h2>
                    <div class="w-10 h-[3px] bg-[#5A0E0E]"></div>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-3 bg-red-100 border border-red-200 text-red-700 text-xs rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-xs font-bold tracking-widest text-[#4A4A4A] uppercase mb-2">
                            Nama Pengguna
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-[#8A8A8A]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input 
                                type="text" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', 'admin@talepud.id') }}" 
                                required 
                                autofocus
                                placeholder="admin" 
                                class="w-full pl-12 pr-4 py-3 bg-[#EFECE6] border border-[#D5CFBE] focus:border-[#5A0E0E] focus:outline-none text-sm text-[#1E1E1E] transition-colors"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold tracking-widest text-[#4A4A4A] uppercase mb-2">
                            Kata Sandi
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-[#8A8A8A]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                value="admin123"
                                required 
                                placeholder="••••••••" 
                                class="w-full pl-12 pr-12 py-3 bg-[#EFECE6] border border-[#D5CFBE] focus:border-[#5A0E0E] focus:outline-none text-sm text-[#1E1E1E] transition-colors"
                            >
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute right-4 text-[#8A8A8A] hover:text-[#5A0E0E] focus:outline-none">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="#" class="text-xs text-[#555] hover:text-[#5A0E0E] transition-colors">
                            Lupa Kata Sandi?
                        </a>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-4 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-xs font-bold tracking-widest uppercase transition-colors shadow-sm"
                    >
                        Masuk ke Sistem Manajemen
                    </button>
                </form>

                <!-- Divider Aksara / Ornamen -->
                <div class="mt-10 flex items-center justify-center space-x-3 text-[#B0A795]">
                    <div class="h-[1px] w-16 bg-[#D8D2C4]"></div>
                    <svg class="w-4 h-4 text-[#A89D88]" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="12" r="3" />
                        <circle cx="12" cy="5" r="2" />
                        <circle cx="12" cy="19" r="2" />
                        <circle cx="5" cy="12" r="2" />
                        <circle cx="19" cy="12" r="2" />
                    </svg>
                    <div class="h-[1px] w-16 bg-[#D8D2C4]"></div>
                </div>

                <p class="mt-6 text-center text-[11px] leading-relaxed text-[#75726B]">
                    Akses terbatas hanya untuk staf kuratorial berwenang.<br>
                    Wayang Wong Dewa Kocala Raqta Talepud.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-6 text-center text-xs text-[#7A7770] border-t border-[#EAE6DF]">
        &copy; 2026 Wayang Wong Dewa Kocala Raqta Talepud. Archival Excellence.
    </footer>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>
</html>