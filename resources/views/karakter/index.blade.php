@extends('layouts.app')

@section('title', 'Tokoh Karakter Wayang Wong')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-10 py-12 sm:py-16">
    <!-- Header Halaman -->
    <div class="flex flex-col md:flex-row md:items-end justify-between pb-8 border-b border-[#EAE6DF] mb-12 gap-6">
        <div>
            <span class="text-[10px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-2">
                DRAMATURGI & REPERTOAR
            </span>
            <h1 class="font-serif-celtic text-3xl sm:text-5xl font-bold text-[#5A0E0E] tracking-tight">
                Tokoh Karakter
            </h1>
            <p class="text-xs text-[#7A7770] mt-2 max-w-xl">
                Eksplorasi watak, gerak tari, vokal sesolahan, dan perwujudan tokoh wiracarita Wayang Wong Banjar Talepud.
            </p>
        </div>

        <!-- Kolom Pencarian Karakter -->
        <form action="{{ route('karakter.index') }}" method="GET" class="relative w-full md:w-80">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#999]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}" 
                placeholder="CARI NAMA KARAKTER / PERAN..." 
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#D5CFBE] text-xs text-[#1E1E1E] placeholder-[#999] tracking-wider uppercase focus:outline-none focus:border-[#5A0E0E]"
            >
        </form>
    </div>

    <!-- Grid 3 Kolom Karakter -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
        @forelse($karakters as $item)
            @php
                $imgUrl = $item->visual_karakter ?: ($item->topeng?->foto_cover ?? '');
                $targetVideoUrl = $item->video_youtube ? route('karakter.video', $item->id_karakter) : '#';
            @endphp
            <div class="border border-[#EAE6DF] bg-white p-6 flex flex-col justify-between group hover:border-[#D5CFBE] transition-colors">
                <div>
                    <!-- Thumbnail: Klik langsung membuka Halaman Video YouTube -->
                    <a href="{{ $targetVideoUrl }}" class="block aspect-[3/4] w-full bg-[#FAF9F7] border border-[#EAE6DF] overflow-hidden relative group/thumb">
                        @if($imgUrl)
                            <img 
                                src="{{ $imgUrl }}" 
                                alt="{{ $item->nama_karakter }}" 
                                class="w-full h-full object-cover group-hover/thumb:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs font-bold text-[#A89D88] uppercase tracking-widest">
                                Visual Kosong
                            </div>
                        @endif

                        @if($item->video_youtube)
                            <!-- Tombol Play Overlay di atas gambar -->
                            <div class="absolute inset-0 bg-black/30 group-hover/thumb:bg-black/50 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-[#5A0E0E]/90 text-white flex items-center justify-center shadow-lg transform group-hover/thumb:scale-110 transition-transform">
                                    <svg class="w-5 h-5 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                            <span class="absolute bottom-3 right-3 px-2 py-0.5 bg-black/80 text-white text-[9px] font-bold tracking-widest uppercase">
                                TONTON SOLAH
                            </span>
                        @endif
                    </a>

                    <!-- Metadata Karakter -->
                    <div class="mt-5">
                        <span class="text-[9px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block">
                            {{ $item->peran ?: 'TOKOH REPERTOAR' }}
                        </span>
                        <h3 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mt-1 group-hover:text-[#5A0E0E] transition-colors">
                            {{ $item->nama_karakter }}
                        </h3>
                        <p class="text-xs text-[#666] mt-2 line-clamp-3 leading-relaxed">
                            {{ $item->deskripsi ?: 'Karakter wayang wong yang mengemban nilai simbolis dalam tradisi ritual pementasan sakral.' }}
                        </p>
                    </div>

                    <!-- Audio Vokal / Dialog Tokoh -->
                    @if($item->audio_karakter)
                        <div class="mt-4 pt-3 border-t border-[#EAE6DF]">
                            <span class="text-[9px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">
                                SUARA / TEMBANG KARAKTER
                            </span>
                            <audio controls class="h-7 w-full">
                                <source src="{{ $item->audio_karakter }}" type="audio/mpeg">
                            </audio>
                        </div>
                    @endif
                </div>

                <!-- Tautan Aksi Bawah -->
                <div class="pt-4 border-t border-[#EAE6DF] mt-6 flex items-center justify-between">
                    @if($item->video_youtube)
                        <a href="{{ route('karakter.video', $item->id_karakter) }}" class="text-[10px] font-bold tracking-[0.18em] text-red-700 hover:text-red-900 uppercase inline-flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1.5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            CUPLIKAN TARI &rarr;
                        </a>
                    @else
                        <span class="text-[10px] text-[#A89D88] uppercase italic">Video belum diunggah</span>
                    @endif

                    @if($item->topeng)
                        <a href="{{ route('topeng.show', $item->topeng->id_topeng) }}" class="text-[10px] font-bold tracking-[0.18em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase">
                            TAPEL &rarr;
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-xs text-[#8A8477] italic">
                Belum ada data tokoh karakter yang tersimpan.
            </div>
        @endforelse
    </div>

    <!-- Paginasi -->
    <div class="mt-14 flex justify-center">
        {{ $karakters->links() }}
    </div>
</div>
@endsection