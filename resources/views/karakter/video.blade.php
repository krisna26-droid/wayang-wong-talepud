@extends('layouts.app')

@section('title', 'Cuplikan Solah: ' . $karakter->nama_karakter)

@section('content')
<div class="w-full bg-[#1C1C1C] text-white flex flex-col items-center pt-12 sm:pt-16 pb-16 px-4 sm:px-6">
    <div class="max-w-5xl w-full text-center">
        <!-- Judul & Peran Karakter -->
        <span class="text-[10px] sm:text-[11px] font-bold tracking-[0.28em] text-[#C2A36B] uppercase block mb-2">
            REPERTOAR GERAK TARI SAKRAL &mdash; {{ strtoupper($karakter->peran ?: 'WAYANG WONG') }}
        </span>
        <h1 class="font-serif-celtic text-3xl sm:text-5xl md:text-6xl font-normal tracking-tight text-[#FAF8F5]">
            {{ $karakter->nama_karakter }}
        </h1>

        <!-- Bingkai Pemutar YouTube Berlayar Penuh -->
        <div class="mt-8 sm:mt-10 relative w-full aspect-video bg-black border border-[#333] shadow-2xl overflow-hidden">
            @if($karakter->youtube_embed_url)
                <iframe 
                    class="w-full h-full"
                    src="{{ $karakter->youtube_embed_url }}?autoplay=1&rel=0&modestbranding=1" 
                    title="Solah Tari {{ $karakter->nama_karakter }}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            @else
                <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                    <svg class="w-16 h-16 text-[#555] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-[#888]">Tautan video YouTube belum didaftarkan untuk karakter ini.</p>
                </div>
            @endif
        </div>

        <!-- Deskripsi Kontekstual & Audio Pelengkap Bawah Video -->
        <div class="mt-8 text-left bg-[#141414] border border-[#2A2A2A] p-6 sm:p-8 grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
            <div class="md:col-span-8 space-y-3">
                <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block">DESKRIPSI TOKOH & SOLAH</span>
                <p class="text-xs sm:text-sm text-[#BBB] leading-relaxed">
                    {{ $karakter->deskripsi ?: 'Tidak ada uraian narasi gerak khusus.' }}
                </p>
                @if($karakter->topeng)
                    <div class="pt-3">
                        <span class="text-[10px] text-[#777] uppercase tracking-wider block">Topeng Terkait:</span>
                        <a href="{{ route('topeng.show', $karakter->topeng->id_topeng) }}" class="text-xs font-bold text-[#C2A36B] hover:underline">
                            {{ $karakter->topeng->nama_topeng }} &rarr;
                        </a>
                    </div>
                @endif
            </div>

            <!-- Rekaman Audio & Pemeran Terkait -->
            <div class="md:col-span-4 space-y-4 border-t md:border-t-0 md:border-l border-[#2A2A2A] md:pl-6 pt-4 md:pt-0">
                @if($karakter->audio_karakter)
                    <div>
                        <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block mb-1">
                            SUARA / TEMBANG TOKOH
                        </span>
                        <audio controls class="h-7 w-full">
                            <source src="{{ $karakter->audio_karakter }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endif

                @if($karakter->pemerans && $karakter->pemerans->isNotEmpty())
                    <div>
                        <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block mb-1">
                            DITARIKAN OLEH
                        </span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($karakter->pemerans as $pem)
                                <span class="text-[10px] px-2.5 py-1 bg-[#222] text-[#CCC] border border-[#333]">
                                    {{ $pem->nama_pemeran }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Navigasi Bar Kembali ke Katalog Karakter -->
<div class="w-full bg-[#FAF8F5] py-3.5 px-6 sm:px-12 border-t border-[#D5CFBE]">
    <div class="max-w-7xl mx-auto flex items-center">
        <a href="{{ route('karakter.index') }}" class="text-[10px] font-bold tracking-[0.18em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase flex items-center">
            <span class="mr-2 text-sm">&larr;</span> KEMBALI KE KATALOG KARAKTER
        </a>
    </div>
</div>
@endsection