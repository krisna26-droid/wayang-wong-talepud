@extends('layouts.app')

@section('title', 'Sejarah Wayang Wong')

@section('content')
<div class="w-full bg-[#1C1C1C] text-white flex flex-col items-center pt-12 sm:pt-16 pb-16 px-4 sm:px-6">
    <div class="max-w-5xl w-full text-center">
        <h1 class="font-serif-celtic text-3xl sm:text-5xl md:text-6xl font-normal tracking-tight text-[#FAF8F5]">
            Dewa Kocala Raqta Talepud
        </h1>
        <span class="text-[10px] sm:text-[11px] font-bold tracking-[0.28em] text-[#C2A36B] uppercase block mt-3">
            SEJARAH WAYANG WONG DEWA KOCALA RAQTA TALEPUD
        </span>

        <!-- Bingkai Pemutar Video Dokumenter Dinamis -->
        <div class="mt-10 sm:mt-12 relative w-full aspect-video bg-black border border-[#333] shadow-2xl overflow-hidden">
            @php
                $embedUrl = $videoSejarah?->youtube_embed_url ?? 'https://www.youtube.com/embed/YXXp_zRjFHk';
            @endphp
            <iframe 
                class="w-full h-full"
                src="{{ $embedUrl }}?autoplay=0&rel=0&modestbranding=1" 
                title="{{ $videoSejarah?->judul_arsip ?? 'Sejarah Wayang Wong - Video Presentation' }}" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>

        @if($videoSejarah)
            <div class="mt-6 text-left border-t border-[#333] pt-4">
                <h3 class="text-sm font-bold text-[#EAE6DF]">{{ $videoSejarah->judul_arsip }}</h3>
                <p class="text-xs text-[#888] mt-1">{{ $videoSejarah->deskripsi }}</p>
            </div>
        @endif
    </div>
</div>

<div class="w-full bg-[#FAF8F5] py-3.5 px-6 sm:px-12 border-t border-[#D5CFBE]">
    <div class="max-w-7xl mx-auto flex items-center">
        <a href="{{ route('home') }}" class="text-[10px] font-bold tracking-[0.18em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase flex items-center">
            <span class="mr-2 text-sm">&larr;</span> KEMBALI KE BERANDA
        </a>
    </div>
</div>
@endsection