@extends('layouts.app')

@section('title', 'Seniman Pemeran Wayang Wong')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-10 py-10 sm:py-14">

    <!-- Bilah Atas: Filter Kategori & Pencarian -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-8 border-b border-[#EAE6DF] mb-12 gap-4">
        <!-- Tombol Filter -->
        <div class="flex items-center space-x-3 text-[10px] font-bold tracking-widest uppercase">
            <span class="text-[#8A8477]">FILTER BY:</span>
            <a href="{{ route('pemeran.index', array_merge(request()->query(), ['filter' => request('filter') === 'seniwati' ? null : 'seniwati'])) }}" 
               class="px-4 py-2 border transition-colors {{ request('filter') === 'seniwati' ? 'bg-[#5A0E0E] text-white border-[#5A0E0E]' : 'bg-white border-[#D5CFBE] text-[#4A4A4A] hover:border-[#5A0E0E]' }}">
                SENIWATI
            </a>
            <a href="{{ route('pemeran.index', array_merge(request()->query(), ['filter' => request('filter') === 'seniwan' ? null : 'seniwan'])) }}" 
               class="px-4 py-2 border transition-colors {{ request('filter') === 'seniwan' ? 'bg-[#5A0E0E] text-white border-[#5A0E0E]' : 'bg-white border-[#D5CFBE] text-[#4A4A4A] hover:border-[#5A0E0E]' }}">
                SENIWAN
            </a>
            @if(request('filter') || request('search'))
                <a href="{{ route('pemeran.index') }}" class="text-[#8B6B3E] hover:underline normal-case text-xs ml-2">Reset</a>
            @endif
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('pemeran.index') }}" method="GET" class="relative w-full md:w-80">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#999]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}" 
                placeholder="CARI PEMERAN..." 
                class="w-full pl-10 pr-4 py-2 bg-white border border-[#D5CFBE] text-xs text-[#1E1E1E] placeholder-[#999] tracking-wider uppercase focus:outline-none focus:border-[#5A0E0E]"
            >
        </form>
    </div>

    <!-- 1. Profil Sorotan Utama (Featured Performer) -->
    @if($featuredPemeran)
        <section class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-14 items-center mb-20">
            <!-- Foto Profil Sorotan -->
            <div class="md:col-span-5">
                <div class="aspect-[3/4] bg-[#EAE6DF] border border-[#D5CFBE] overflow-hidden shadow-sm flex items-center justify-center">
                    @if($featuredPemeran->foto_pemeran)
                        <img 
                            src="{{ $featuredPemeran->foto_pemeran }}" 
                            alt="{{ $featuredPemeran->nama_pemeran }}" 
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                        >
                    @else
                        <!-- Placeholder Avatar Default jika belum ada foto -->
                        <div class="w-full h-full flex items-center justify-center bg-[#FAF9F7]">
                            <svg class="w-32 h-32 text-[#C5BFAe]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Teks Profil Sorotan -->
            <div class="md:col-span-7 space-y-4">
                <span class="text-[10px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block">
                    {{ $featuredPemeran->pengalaman ?? 'MAESTRO SENI TARI' }}
                </span>

                <h1 class="font-serif-celtic text-3xl sm:text-5xl font-bold text-[#5A0E0E] leading-tight">
                    {{ $featuredPemeran->nama_pemeran }}
                </h1>

                <p class="text-xs sm:text-sm text-[#666] leading-relaxed max-w-xl">
                    {{ $featuredPemeran->biodata_singkat ?? 'Mendedikasikan perjalanan hidupnya dalam menghidupkan dan melestarikan seni tari Wayang Wong Banjar Talepud.' }}
                </p>

                <!-- Label Karakter Yang Diperankan -->
                <div class="pt-3 border-t border-[#EAE6DF] max-w-xl">
                    <span class="text-[9px] font-bold tracking-widest text-[#8A8477] uppercase block mb-2">PEMERAN DARI</span>
                    <div class="flex flex-wrap gap-2">
                        @forelse($featuredPemeran->karakters as $karakter)
                            <span class="px-3 py-1 bg-[#FAF9F7] border border-[#EAE6DF] text-[10px] font-bold tracking-widest text-[#1E1E1E] uppercase">
                                {{ $karakter->nama_karakter }}
                            </span>
                        @empty
                            <span class="text-xs text-[#888] italic">Belum terhubung ke karakter tari spesifik.</span>
                        @endforelse
                    </div>
                </div>

                @if($featuredPemeran->video_youtube)
                    <div class="pt-2">
                        <a href="{{ $featuredPemeran->video_youtube }}" target="_blank" class="inline-flex items-center text-xs font-bold text-red-700 hover:underline">
                            <svg class="w-4 h-4 mr-1.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            Tonton Rekaman Pementasan Langsung &nearr;
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Pemisah Hiasan -->
    <div class="flex items-center justify-center space-x-3 my-16 text-[#8B6B3E]">
        <span class="w-16 h-px bg-[#D5CFBE]"></span>
        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2L9 9H2l6 4.5L5.5 21 12 16.5 18.5 21 16 13.5 22 9h-7z"/></svg>
        <span class="w-16 h-px bg-[#D5CFBE]"></span>
    </div>

    <!-- 2. Grid Daftar Pemeran (3 Kolom per Baris Sesuai Gambar) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
        @forelse($pemerans as $item)
            <div class="flex flex-col justify-between group">
                <div>
                    <!-- Kotak Foto / Avatar Karikatur Minimalis -->
                    <div class="aspect-square bg-[#FAF9F7] border border-[#EAE6DF] overflow-hidden flex items-center justify-center p-4">
                        @if($item->foto_pemeran)
                            <img 
                                src="{{ $item->foto_pemeran }}" 
                                alt="{{ $item->nama_pemeran }}" 
                                class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 transition-all duration-500"
                            >
                        @else
                            <!-- Placeholder Garis Avatar Kepala Sesuai Gambar Desain -->
                            <svg class="w-36 h-36 text-[#1E1E1E]" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="4">
                                <circle cx="50" cy="35" r="22" stroke-linecap="round"/>
                                <path d="M18 88c0-18 14-32 32-32s32 14 32 32" stroke-linecap="round"/>
                            </svg>
                        @endif
                    </div>

                    <!-- Masa Pengalaman -->
                    <span class="text-[9px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block mt-5">
                        {{ $item->pengalaman ?: 'PENARI SENIMAN' }}
                    </span>

                    <!-- Nama Pemeran -->
                    <h3 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mt-1 group-hover:text-[#5A0E0E] transition-colors">
                        {{ $item->nama_pemeran }}
                    </h3>

                    <!-- Biodata Ringkas -->
                    <p class="text-xs text-[#666] mt-2 line-clamp-3 leading-relaxed">
                        {{ $item->biodata_singkat ?: 'Seniman pemeran pelestari pakem tari pementasan sakral Wayang Wong Dewa Kocala Raqta Talepud.' }}
                    </p>
                </div>

                <!-- Karakter Terkait & Video -->
                <div class="pt-4 border-t border-[#EAE6DF] mt-6">
                    <span class="text-[9px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">
                        PEMERAN: 
                        <span class="text-[#1E1E1E]">
                            @if($item->karakters->isNotEmpty())
                                {{ $item->karakters->pluck('nama_karakter')->join(', ') }}
                            @else
                                -
                            @endif
                        </span>
                    </span>

                    @if($item->video_youtube)
                        <a href="{{ $item->video_youtube }}" target="_blank" class="inline-flex items-center text-[10px] font-bold text-red-700 hover:underline uppercase tracking-wider mt-1">
                            Lihat Pentas &nearr;
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-xs text-[#8A8477] italic">
                Tidak ada data seniman pemeran yang ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Paginasi -->
    <div class="mt-14 flex justify-center">
        {{ $pemerans->links() }}
    </div>

    <!-- 3. Kutipan Filosofis Penutup -->
    <section class="max-w-3xl mx-auto px-6 pt-24 pb-12 text-center">
        <span class="font-serif-celtic text-3xl sm:text-4xl text-[#5A0E0E] font-bold block mb-4">”</span>
        <blockquote class="font-serif-quote italic text-base sm:text-xl text-[#1E1E1E] leading-relaxed">
            "The mask does not cover the performer; it reveals the character through the performer's breath. Without the lineage, the wood remains silent."
        </blockquote>
        <span class="text-[10px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mt-6">
            &mdash; ARSIP DEWA KOCALA, 1984
        </span>
    </section>

</div>
@endsection