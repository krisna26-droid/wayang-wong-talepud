@extends('layouts.app')

@section('title', $topeng->nama_topeng . ' - Rincian Koleksi Topeng')

@section('content')
<!-- Library Model Viewer untuk render 3D .GLB jika ada -->
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>

<div class="max-w-7xl mx-auto px-6 sm:px-10 py-10 sm:py-12">
    <!-- Navigasi Kembali -->
    <div class="mb-8">
        <a href="{{ route('topeng.index') }}" class="text-[10px] font-bold tracking-[0.2em] text-[#4A4A4A] hover:text-[#5A0E0E] uppercase inline-flex items-center">
            <span class="mr-2 text-xs">&larr;</span> KEMBALI KE KOLEKSI TOPENG
        </a>
    </div>

    <!-- Tampilan Visual Utama & Narasi Dasar -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start pb-16 border-b border-[#EAE6DF]">
        <!-- Penampil Visual (3D atau Gambar) -->
        <div class="lg:col-span-7">
            <div class="w-full aspect-[4/3] bg-[#FAF9F7] border border-[#EAE6DF] p-6 flex items-center justify-center overflow-hidden relative">
                @if($topeng->model_3d)
                    <model-viewer 
                        src="{{ $topeng->model_3d }}" 
                        camera-controls 
                        auto-rotate 
                        shadow-intensity="1" 
                        class="w-full h-full">
                    </model-viewer>
                    <span class="absolute bottom-4 right-4 text-[9px] font-bold tracking-widest uppercase bg-[#5A0E0E] text-white px-2.5 py-1">
                        MODEL 3D INTERAKTIF
                    </span>
                @elseif($topeng->foto_cover)
                    <img 
                        src="{{ $topeng->foto_cover }}" 
                        alt="{{ $topeng->nama_topeng }}" 
                        class="max-h-full max-w-full object-contain"
                    >
                @else
                    <span class="font-serif-celtic text-xs text-[#A89D88] uppercase tracking-widest">Visual Belum Tersedia</span>
                @endif
            </div>

            <div class="mt-3 flex items-center justify-between text-[10px] text-[#8A8477]">
                <span class="uppercase tracking-widest">&bull; DOKUMENTASI INVENTARIS BANJAR TALEPUD</span>
                <span>{{ $topeng->tanggal_dokumentasi ? \Carbon\Carbon::parse($topeng->tanggal_dokumentasi)->locale('id')->isoFormat('D MMMM Y') : 'TERCATAT' }}</span>
            </div>
        </div>

        <!-- Profil Teks Kanan -->
        <div class="lg:col-span-5 flex flex-col justify-between h-full">
            <div>
                <span class="text-[10px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-2">
                    KLASIFIKASI: {{ strtoupper($topeng->kategori ?: 'TAPEL WAYANG WONG') }}
                </span>
                <h1 class="font-serif-celtic text-3xl sm:text-5xl font-bold text-[#5A0E0E] leading-tight">
                    {{ $topeng->nama_topeng }}
                </h1>
                <p class="font-serif-quote italic text-sm text-[#7A7770] mt-2 mb-6">
                    {{ $topeng->periode_sejarah ?: 'Artefak sakral pementasan Wayang Wong Desa Adat Talepud.' }}
                </p>
                <div class="text-xs text-[#555] leading-relaxed space-y-3">
                    <p>{{ $topeng->deskripsi ?: 'Belum ada uraian narasi untuk koleksi ini.' }}</p>
                </div>
            </div>

            <!-- Ringkasan Cepat Material & Fungsi -->
            <div class="mt-8 pt-6 border-t border-[#EAE6DF] grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#8A8477] block mb-1">BAHAN UTAMA</span>
                    <span class="font-semibold text-[#1E1E1E]">{{ $topeng->bahan_pembuatan ?: 'Kayu Pule' }}</span>
                </div>
                <div>
                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#8A8477] block mb-1">STATUS KOLEKSI</span>
                    <span class="font-semibold text-[#1E1E1E]">{{ $topeng->kondisi_koleksi ?: 'Terawat' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Karakter Terkait yang Menggunakan Topeng Ini -->
    @if($topeng->karakters && $topeng->karakters->isNotEmpty())
        <div class="py-14 border-b border-[#EAE6DF]">
            <span class="text-[9px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-2">TOKOH TERIKAT</span>
            <h2 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mb-8">Karakter Dalam Pementasan</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($topeng->karakters as $karakter)
                    <div class="bg-[#FAF9F7] border border-[#EAE6DF] p-5 flex items-center space-x-4">
                        <div class="w-16 h-16 bg-[#EAE6DF] shrink-0 border border-[#D5CFBE] overflow-hidden">
                            @if($karakter->visual_karakter)
                                <img src="{{ $karakter->visual_karakter }}" alt="{{ $karakter->nama_karakter }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[9px] font-bold text-[#8A8477]">N/A</div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="text-[9px] font-bold tracking-widest text-[#8B6B3E] uppercase block">{{ $karakter->peran ?: 'TOKOH' }}</span>
                            <h3 class="font-serif-celtic font-bold text-base text-[#1E1E1E] truncate">{{ $karakter->nama_karakter }}</h3>
                            @if($karakter->audio_karakter)
                                <audio controls class="h-6 w-full mt-2">
                                    <source src="{{ $karakter->audio_karakter }}" type="audio/mpeg">
                                </audio>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Makna Filosofis & Nilai Estetika -->
    <div class="max-w-4xl mx-auto py-16 text-center border-b border-[#EAE6DF] space-y-8">
        <div>
            <h2 class="font-serif-celtic text-2xl sm:text-3xl font-bold text-[#1E1E1E]">
                Makna Filosofis & Nilai Estetika
            </h2>
            @if($topeng->makna_filosofis)
                <p class="font-serif-quote italic text-base text-[#5A0E0E] mt-4 leading-relaxed max-w-2xl mx-auto">
                    &ldquo;{{ $topeng->makna_filosofis }}&rdquo;
                </p>
            @endif
        </div>

        @if($topeng->nilai_estetika)
            <div class="pt-4 border-t border-[#EAE6DF]/60 max-w-2xl mx-auto">
                <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block mb-2">PENGHAYATAN ESTETIS</span>
                <p class="text-xs sm:text-sm text-[#666] leading-relaxed">
                    {{ $topeng->nilai_estetika }}
                </p>
            </div>
        @endif
    </div>

    <!-- Metadata Teknis Detail -->
    <div class="py-14">
        <div class="bg-[#FCFBFA] border border-[#EAE6DF] p-8 sm:p-10">
            <div class="pb-4 border-b border-[#EAE6DF] mb-6">
                <span class="text-[9px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-1">INVENTORY LOG</span>
                <h3 class="font-serif-celtic text-xl font-bold text-[#1E1E1E]">Metadata Koleksi</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8 text-xs">
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">KODE IDENTIFIKASI</span>
                    <span class="font-medium text-[#1E1E1E]">DKRT-TPG-{{ str_pad($topeng->id_topeng, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">LOKASI PENYIMPANAN</span>
                    <span class="font-medium text-[#1E1E1E]">{{ $topeng->lokasi_penyimpanan ?: 'Gedong Simpen Pura Bale Bang' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PEMILIK / HAK ADAT</span>
                    <span class="font-medium text-[#1E1E1E]">{{ $topeng->pemilik ?: 'Krama Desa Adat Talepud' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PENGELOLA ARTEFAK</span>
                    <span class="font-medium text-[#1E1E1E]">{{ $topeng->pengelola ?: 'Seka Wayang Wong Dewa Kocala Raqta' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">FUNGSI PERTUNJUKAN</span>
                    <span class="font-medium text-[#1E1E1E]">{{ $topeng->fungsi_pertunjukan ?: 'Upacara Piodalan & Pertunjukan Sakral' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PETUGAS REGISTRASI</span>
                    <span class="font-medium text-[#1E1E1E]">{{ $topeng->petugas_dokumentasi ?: 'Tim Digitalisasi Budaya' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection