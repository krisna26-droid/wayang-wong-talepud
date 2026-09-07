@extends('layouts.app')

@section('title', 'Beranda')

@php
    // GANTI TAUTAN DI BAWAH JIKA INGIN MEMAKAI GAMBAR SPESIFIK:
    $customHeroBanner = ''; // Contoh: 'https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&w=1200&q=80'
    $customTelusuriBanner = ''; // Contoh: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=1200&q=80'

    // Fallback otomatis mengambil aset gambar dari data arsip/topeng jika banner manual belum diisi
    $heroImage = !empty($customHeroBanner) 
        ? $customHeroBanner 
        : ($topengSorotan?->foto_cover ?? ($arsipFotoSampul?->file_media ?? 'https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&w=1200&q=80'));

    $telusuriImage = !empty($customTelusuriBanner) 
        ? $customTelusuriBanner 
        : ($karakterSorotan?->visual_karakter ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=1200&q=80');
@endphp

@section('content')
    <!-- 1. Hero Section -->
    <section class="max-w-7xl mx-auto px-6 sm:px-10 pt-12 sm:pt-20 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            <div class="lg:col-span-7">
                <span class="text-[10px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-4">
                    ARSIP DIGITAL BUDAYA
                </span>
                <h1 class="font-serif-celtic text-4xl sm:text-5xl lg:text-6xl font-bold text-[#5A0E0E] leading-[1.1] tracking-tight">
                    Tradisi Wayang Wong Dewa Kocala Raqta Talepud
                </h1>
                <p class="mt-6 text-sm sm:text-base text-[#666] leading-relaxed max-w-xl">
                    Sebuah dedikasi untuk pelestarian digital seni pertunjukan sakral dari Desa Adat Talepud. Menjaga warisan leluhur melalui dokumentasi komprehensif topeng, karakter, dan sejarah pementasan.
                </p>

                <div class="mt-8 sm:mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ route('arsip.index') }}" class="px-8 py-3.5 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-[11px] font-bold tracking-[0.18em] uppercase transition-colors">
                        JELAJAHI ARSIP
                    </a>
                    <a href="{{ route('sejarah') }}" class="px-8 py-3.5 bg-transparent hover:bg-[#F3EFE9] border border-[#D5CFBE] text-[#4A4A4A] text-[11px] font-bold tracking-[0.18em] uppercase transition-colors">
                        SEJARAH
                    </a>
                </div>
            </div>

            <!-- Slot Gambar Hero Banner -->
            <div class="lg:col-span-5">
                <div class="aspect-[4/5] w-full bg-[#EAE6DF] border border-[#E0DACF] overflow-hidden shadow-sm">
                    <img 
                        src="{{ $heroImage }}" 
                        alt="Tradisi Wayang Wong Talepud" 
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Kutipan Filosofis -->
    <section class="max-w-4xl mx-auto px-6 py-16 sm:py-20 text-center">
        <div class="w-12 h-px bg-[#C9BFB0] mx-auto mb-8 sm:mb-10"></div>
        <h2 class="font-serif-quote italic text-2xl sm:text-4xl text-[#5A0E0E] leading-relaxed">
            "Menghidupkan Kembali Suara Leluhur di Era Digital."
        </h2>
        <p class="mt-6 text-xs sm:text-sm text-[#777] max-w-2xl mx-auto leading-relaxed">
            Wayang Wong Desa Adat Talepud bukan sekadar pertunjukan; ia adalah nafas spiritual masyarakat kami. Melalui platform ini, kami membuka pintu bagi dunia untuk mempelajari detail teknis dan esensi filosofis dari setiap gerakan dan karakter yang telah diturunkan selama berabad-abad.
        </p>
        <div class="w-12 h-px bg-[#C9BFB0] mx-auto mt-8 sm:mt-10"></div>
    </section>

    <!-- 3. Fragmen Tradisi Dinamis -->
    <section class="max-w-7xl mx-auto px-6 sm:px-10 py-12 sm:py-16">
        <div class="flex items-end justify-between pb-6 sm:pb-8 border-b border-[#EAE6DF] mb-10 sm:mb-12">
            <div>
                <span class="text-[9px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-1">
                    KOLEKSI PILIHAN
                </span>
                <h3 class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">
                    Fragmen Tradisi
                </h3>
            </div>
            <a href="{{ route('arsip.index') }}" class="text-[10px] font-bold tracking-[0.2em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase">
                LIHAT SEMUA ARSIP &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
            <!-- Kartu Karakter -->
            <div class="flex flex-col justify-between group">
                <div>
                    <div class="aspect-[3/4] bg-[#EAE6DF] overflow-hidden border border-[#E0DACF] flex items-center justify-center">
                        @if($karakterSorotan && ($karakterSorotan->visual_karakter || ($karakterSorotan->topeng && $karakterSorotan->topeng->foto_cover)))
                            <img 
                                src="{{ $karakterSorotan->visual_karakter ?: $karakterSorotan->topeng->foto_cover }}" 
                                alt="{{ $karakterSorotan->nama_karakter }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs font-bold text-[#A89D88] uppercase tracking-widest">
                                Tidak Ada Visual
                            </div>
                        @endif
                    </div>
                    <span class="text-[9px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block mt-6">
                        KARAKTER
                    </span>
                    <h4 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mt-1">
                        {{ $karakterSorotan ? $karakterSorotan->nama_karakter : 'Belum Ada Data' }}
                    </h4>
                    <p class="text-xs text-[#666] mt-2 line-clamp-2 leading-relaxed">
                        {{ $karakterSorotan && $karakterSorotan->deskripsi ? $karakterSorotan->deskripsi : 'Dokumentasi detail tokoh, watak peran, serta ragam busana adat wayang wong.' }}
                    </p>
                </div>
                <a href="{{ route('karakter.index') }}" class="text-[10px] font-bold tracking-[0.18em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase mt-6 inline-flex items-center">
                    DETAIL ARSIP &rarr;
                </a>
            </div>

            <!-- Kartu Topeng -->
            <div class="flex flex-col justify-between group">
                <div>
                    <div class="aspect-[3/4] bg-[#EAE6DF] overflow-hidden border border-[#E0DACF] flex items-center justify-center">
                        @if($topengSorotan && $topengSorotan->foto_cover)
                            <img 
                                src="{{ $topengSorotan->foto_cover }}" 
                                alt="{{ $topengSorotan->nama_topeng }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs font-bold text-[#A89D88] uppercase tracking-widest">
                                Tidak Ada Visual
                            </div>
                        @endif
                    </div>
                    <span class="text-[9px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block mt-6">
                        TOPENG
                    </span>
                    <h4 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mt-1">
                        {{ $topengSorotan ? $topengSorotan->nama_topeng : 'Belum Ada Data' }}
                    </h4>
                    <p class="text-xs text-[#666] mt-2 line-clamp-2 leading-relaxed">
                        {{ $topengSorotan && $topengSorotan->deskripsi ? $topengSorotan->deskripsi : 'Koleksi tapel kuno yang disakralkan dan dipelihara di Pura Bale Bang Talepud.' }}
                    </p>
                </div>
                <a href="{{ route('topeng.index') }}" class="text-[10px] font-bold tracking-[0.18em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase mt-6 inline-flex items-center">
                    DETAIL ARSIP &rarr;
                </a>
            </div>

            <!-- Kartu Pemeran -->
            <div class="flex flex-col justify-between group">
                <div>
                    <div class="aspect-[3/4] bg-[#EAE6DF] overflow-hidden border border-[#E0DACF] flex items-center justify-center">
                        @if($pemeranSorotan && $pemeranSorotan->foto_pemeran)
                            <img 
                                src="{{ $pemeranSorotan->foto_pemeran }}" 
                                alt="{{ $pemeranSorotan->nama_pemeran }}" 
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs font-bold text-[#A89D88] uppercase tracking-widest">
                                Tidak Ada Visual
                            </div>
                        @endif
                    </div>
                    <span class="text-[9px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block mt-6">
                        PEMERAN
                    </span>
                    <h4 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mt-1">
                        {{ $pemeranSorotan ? $pemeranSorotan->nama_pemeran : 'Belum Ada Data' }}
                    </h4>
                    <p class="text-xs text-[#666] mt-2 line-clamp-2 leading-relaxed">
                        {{ $pemeranSorotan && $pemeranSorotan->biodata_singkat ? $pemeranSorotan->biodata_singkat : 'Mendokumentasikan para seniman penari dan penjaga tradisi lintas generasi.' }}
                    </p>
                </div>
                <a href="{{ route('pemeran.index') }}" class="text-[10px] font-bold tracking-[0.18em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase mt-6 inline-flex items-center">
                    DETAIL ARSIP &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- 4. Telusuri Lebih Dalam -->
    <section class="w-full bg-[#161616] text-white py-16 sm:py-20 mt-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            <div class="lg:col-span-7">
                <h3 class="font-serif-celtic text-3xl sm:text-5xl font-bold leading-tight mb-8">
                    Telusuri<br>Lebih Dalam
                </h3>

                <div class="divide-y divide-[#333]">
                    <a href="{{ route('topeng.index') }}" class="py-5 flex items-center justify-between group hover:pl-2 transition-all">
                        <div class="flex items-baseline space-x-3">
                            <span class="font-serif-celtic text-xl sm:text-2xl text-[#EAE6DF] group-hover:text-white">Topeng</span>
                            <span class="text-[10px] text-[#777]">({{ $totalTopeng }} Koleksi)</span>
                        </div>
                        <svg class="w-6 h-6 text-[#9E9E9E] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>

                    <a href="{{ route('karakter.index') }}" class="py-5 flex items-center justify-between group hover:pl-2 transition-all">
                        <div class="flex items-baseline space-x-3">
                            <span class="font-serif-celtic text-xl sm:text-2xl text-[#EAE6DF] group-hover:text-white">Karakter</span>
                            <span class="text-[10px] text-[#777]">({{ $totalKarakter }} Tokoh)</span>
                        </div>
                        <svg class="w-6 h-6 text-[#9E9E9E] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>

                    <a href="{{ route('pemeran.index') }}" class="py-5 flex items-center justify-between group hover:pl-2 transition-all">
                        <div class="flex items-baseline space-x-3">
                            <span class="font-serif-celtic text-xl sm:text-2xl text-[#EAE6DF] group-hover:text-white">Profil Pemeran</span>
                            <span class="text-[10px] text-[#777]">({{ $totalPemeran }} Penari)</span>
                        </div>
                        <svg class="w-6 h-6 text-[#9E9E9E] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Slot Gambar Samping Menu Telusuri -->
            <div class="lg:col-span-5">
                <div class="aspect-[4/3] sm:aspect-[16/10] bg-[#222] border border-[#333] overflow-hidden">
                    <img 
                        src="{{ $telusuriImage }}" 
                        alt="Pementasan Wayang Wong" 
                        class="w-full h-full object-cover opacity-85 hover:opacity-100 transition-opacity duration-300"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Filosofi Tekstur & Metrik Aktual -->
    <section class="max-w-7xl mx-auto px-6 sm:px-10 py-20 sm:py-24">
        <div class="max-w-xl">
            <span class="text-[9px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-3">
                FILOSOFI TEKSTUR
            </span>
            <h3 class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E] leading-tight">
                Keagungan yang Terpahat dalam Kayu dan Waktu.
            </h3>
            <p class="mt-6 text-xs sm:text-sm text-[#666] leading-relaxed">
                Setiap lekukan pada topeng kami menceritakan kisah ketaatan. Dari pemilihan kayu Pule yang sakral hingga ritual pewarnaan yang memakan waktu berbulan-bulan, Wayang Wong Dewa Kocala adalah manifestasi dari kesabaran dan pengabdian artistik.
            </p>

            <div class="mt-10 sm:mt-12 flex items-center space-x-10 sm:space-x-16 border-t border-[#EAE6DF] pt-8">
                <div>
                    <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">12+</span>
                    <span class="text-[9px] font-bold tracking-widest text-[#8A8477] uppercase block mt-1">GENERASI</span>
                </div>
                <div>
                    <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">{{ $totalTopeng }}</span>
                    <span class="text-[9px] font-bold tracking-widest text-[#8A8477] uppercase block mt-1">KOLEKSI TOPENG</span>
                </div>
                <div>
                    <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">{{ $totalArsip }}</span>
                    <span class="text-[9px] font-bold tracking-widest text-[#8A8477] uppercase block mt-1">DOKUMEN DIGITAL</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Akses Institusional & Akademik -->
    <section class="w-full bg-[#EAE6DF] py-16 sm:py-20 px-6">
        <div class="max-w-3xl mx-auto bg-white p-8 sm:p-14 text-center border border-[#DDD6C9]">
            <h3 class="font-serif-celtic text-2xl sm:text-3xl font-bold text-[#1E1E1E]">
                Akses Institusional & Akademik
            </h3>
            <p class="mt-4 text-xs sm:text-sm text-[#666] max-w-lg mx-auto leading-relaxed">
                Kami menyediakan akses khusus bagi peneliti, akademisi, dan lembaga budaya untuk menelusuri metadata arsip secara mendalam demi kepentingan edukasi.
            </p>
            <div class="mt-8">
                <a href="mailto:sekawayangwong@talepud.desa.id" class="inline-block px-8 py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-[11px] font-bold tracking-[0.2em] uppercase transition-colors">
                    HUBUNGI KAMI
                </a>
            </div>
        </div>
    </section>
@endsection