@extends('layouts.app')

@section('title', $topeng->nama_topeng . ' - Detail Arsip')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-10 py-10 sm:py-12">
    <!-- Tombol Navigasi Kembali -->
    <div class="mb-8">
        <a href="{{ route('arsip.index') }}" class="text-[10px] font-bold tracking-[0.2em] text-[#4A4A4A] hover:text-[#5A0E0E] uppercase inline-flex items-center">
            <span class="mr-2 text-xs">&larr;</span> KEMBALI KE KOLEKSI
        </a>
    </div>

    <!-- 1. Tampilan Utama Topeng & Profil -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start pb-16 border-b border-[#EAE6DF]">
        <!-- Foto Arsip Besar -->
        <div class="lg:col-span-7">
            <div class="w-full aspect-[4/3] bg-[#FAF9F7] border border-[#EAE6DF] p-8 flex items-center justify-center overflow-hidden">
                @if($topeng->foto_cover)
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
                <span class="uppercase tracking-widest">&bull; FOTOGRAFI DOKUMENTASI DIGITAL</span>
                <span>{{ $topeng->tanggal_dokumentasi ? \Carbon\Carbon::parse($topeng->tanggal_dokumentasi)->locale('id')->isoFormat('D MMMM Y') : 'ARSIP DESA ADAT TALEPUD' }}</span>
            </div>
        </div>

        <!-- Deskripsi Utama Kanan -->
        <div class="lg:col-span-5 flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-2">
                    KOLEKSI UTAMA &mdash; {{ strtoupper($topeng->kategori ?: 'TOPENG') }}
                </span>
                <h1 class="font-serif-celtic text-3xl sm:text-5xl font-bold text-[#5A0E0E] leading-tight">
                    {{ $topeng->nama_topeng }}
                </h1>
                <p class="font-serif-quote italic text-sm text-[#7A7770] mt-1 mb-6">
                    {{ $topeng->periode_sejarah ?: 'Circa Abad Ke-20, Banjar Talepud, Gianyar, Bali.' }}
                </p>
                <div class="text-xs text-[#555] leading-relaxed space-y-3">
                    <p>{{ $topeng->deskripsi ?: 'Topeng sakral bagian dari pementasan seni pertunjukan Wayang Wong Dewa Kocala Raqta.' }}</p>
                </div>
            </div>

            @if($topeng->model_3d)
                <div class="mt-8 p-4 bg-[#F8F7F4] border border-[#EAE6DF]">
                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block mb-1">MODEL DIGITAL 3D TERSEDIA</span>
                    <a href="{{ $topeng->model_3d }}" target="_blank" class="text-xs font-bold text-[#5A0E0E] underline uppercase">Unduh Berkas .GLB &nearr;</a>
                </div>
            @endif
        </div>
    </div>

    <!-- 2. Makna Filosofis & Peran Dalam Pertunjukan -->
    <div class="max-w-4xl mx-auto py-16 text-center border-b border-[#EAE6DF]">
        <h2 class="font-serif-celtic text-2xl sm:text-3xl font-bold text-[#1E1E1E]">
            Makna Filosofis & Peran Dalam Pertunjukan
        </h2>

        @if($topeng->makna_filosofis)
            <div class="mt-6">
                <p class="font-serif-quote italic text-sm sm:text-base text-[#5A0E0E] max-w-2xl mx-auto leading-relaxed">
                    &ldquo;{{ $topeng->makna_filosofis }}&rdquo;
                </p>
            </div>
        @endif

        @if($topeng->fungsi_pertunjukan)
            <div class="mt-6 text-xs sm:text-sm text-[#666] max-w-2xl mx-auto leading-relaxed">
                <p>{{ $topeng->fungsi_pertunjukan }}</p>
            </div>
        @endif
    </div>

    <!-- 3. Metadata Penelitian (Technical Documentation) -->
    <div class="py-16 border-b border-[#EAE6DF]">
        <div class="bg-[#FCFBFA] border border-[#EAE6DF] p-8 sm:p-12">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-6 border-b border-[#EAE6DF] mb-8 gap-2">
                <div>
                    <span class="text-[9px] font-bold tracking-[0.25em] text-[#8B6B3E] uppercase block mb-1">TECHNICAL DOCUMENTATION</span>
                    <h3 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E]">Metadata Penelitian</h3>
                </div>
                <span class="text-[10px] text-[#8A8477] uppercase tracking-wider">
                    TERAKHIR DIPERBARUI: {{ $topeng->updated_at ? $topeng->updated_at->locale('id')->isoFormat('D MMMM Y') : '-' }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-10 text-xs">
                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">ARCHIVE ID</span>
                    <span class="text-[#1E1E1E] font-medium">DKRT-T{{ str_pad($topeng->id_topeng, 3, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">NAMA TOPENG</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->nama_topeng }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PEMAHAT / PENCIPTA</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->pencipta_pembuat ?: '-' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">JENIS KOLEKSI</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->jenis_koleksi ?: 'Arsip Topeng Wayang Wong' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">KATEGORI</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->kategori ?: '-' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">FUNGSI DALAM PERTUNJUKAN</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->fungsi_pertunjukan ?: '-' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">LOKASI PENYIMPANAN</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->lokasi_penyimpanan ?: 'Pura Bale Bang Talepud' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PEMILIK</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->pemilik ?: 'Desa Adat Talepud' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PENGELOLA</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->pengelola ?: 'Seka Wayang Wong Dewa Kocala Raqta' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">KONDISI KOLEKSI</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->kondisi_koleksi ?: 'Terawat Baik' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">TANGGAL DOKUMENTASI</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->tanggal_dokumentasi ? \Carbon\Carbon::parse($topeng->tanggal_dokumentasi)->format('d-m-Y') : '-' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PETUGAS DOKUMENTASI</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->petugas_dokumentasi ?: '-' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">BAHAN PEMBUATAN</span>
                    <span class="text-[#1E1E1E] font-medium">{{ $topeng->bahan_pembuatan ?: 'Kayu Pule' }}</span>
                </div>

                <div class="sm:col-span-2">
                    <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase block mb-1">PERIODE SEJARAH / ASAL-USUL</span>
                    <span class="text-[#1E1E1E] font-medium leading-relaxed">{{ $topeng->periode_sejarah ?: '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Nilai Budaya & Nilai Estetika -->
    <div class="py-16 space-y-12 max-w-4xl mx-auto text-center">
        @if($topeng->nilai_budaya)
            <div>
                <span class="font-serif-quote italic text-lg sm:text-xl font-bold text-[#8B6B3E] block mb-2">Nilai Budaya</span>
                <p class="font-serif-celtic text-base sm:text-xl font-semibold text-[#1E1E1E] leading-relaxed">
                    &ldquo;{{ $topeng->nilai_budaya }}&rdquo;
                </p>
            </div>
        @endif

        @if($topeng->nilai_estetika)
            <div>
                <span class="font-serif-quote italic text-lg sm:text-xl font-bold text-[#8B6B3E] block mb-2">Nilai Estetika</span>
                <p class="font-serif-celtic text-base sm:text-xl font-semibold text-[#1E1E1E] leading-relaxed">
                    &ldquo;{{ $topeng->nilai_estetika }}&rdquo;
                </p>
            </div>
        @endif
    </div>
</div>
@endsection