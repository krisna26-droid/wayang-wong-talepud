@extends('layouts.app')

@section('title', 'Arsip Budaya')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-10 py-12 sm:py-16">
    <!-- Judul Halaman -->
    <div class="text-center max-w-xl mx-auto mb-12">
        <h1 class="font-serif-celtic text-3xl sm:text-5xl font-bold text-[#5A0E0E] tracking-tight">
            Arsip Budaya
        </h1>
        <div class="flex items-center justify-center space-x-3 mt-3">
            <span class="w-8 h-px bg-[#C9BFB0]"></span>
            <span class="text-[9px] sm:text-[10px] font-bold tracking-[0.25em] text-[#8A8477] uppercase">
                DIGITAL PRESERVATION SANCTUARY
            </span>
            <span class="w-8 h-px bg-[#C9BFB0]"></span>
        </div>
    </div>

    <!-- Bilah Penyaring Sejajar di Bagian Atas -->
    <div class="bg-[#F8F7F4] border border-[#EAE6DF] p-5 sm:p-6 mb-10">
        <form action="{{ route('arsip.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <!-- Filter Kategori -->
            <div>
                <label class="block text-[10px] font-bold tracking-widest uppercase text-[#7A7770] mb-2">KATEGORI</label>
                <select name="kategori" onchange="this.form.submit()" class="w-full bg-white border border-[#D5CFBE] px-3 py-2.5 text-xs text-[#1E1E1E] focus:outline-none focus:border-[#5A0E0E]">
                    <option value="">Semua Kategori</option>
                    @foreach($daftarKategori as $kat)
                        <option value="{{ $kat }}" {{ $kategori === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun Dokumentasi -->
            <div>
                <label class="block text-[10px] font-bold tracking-widest uppercase text-[#7A7770] mb-2">TAHUN DOKUMENTASI</label>
                <select name="tahun" onchange="this.form.submit()" class="w-full bg-white border border-[#D5CFBE] px-3 py-2.5 text-xs text-[#1E1E1E] focus:outline-none focus:border-[#5A0E0E]">
                    <option value="">Semua Periode</option>
                    <option value="1980-1990" {{ $tahun === '1980-1990' ? 'selected' : '' }}>1980 - 1990</option>
                    <option value="1991-2000" {{ $tahun === '1991-2000' ? 'selected' : '' }}>1991 - 2000</option>
                    <option value="2001-2010" {{ $tahun === '2001-2010' ? 'selected' : '' }}>2001 - 2010</option>
                    <option value="2011-2026" {{ $tahun === '2011-2026' ? 'selected' : '' }}>2011 - 2026</option>
                </select>
            </div>

            <!-- Pencarian Teks -->
            <div>
                <label class="block text-[10px] font-bold tracking-widest uppercase text-[#7A7770] mb-2">PENCARIAN</label>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari nama topeng / bahan..." 
                    class="w-full bg-white border border-[#D5CFBE] px-3 py-2.5 text-xs text-[#1E1E1E] placeholder-[#999] focus:outline-none focus:border-[#5A0E0E]"
                >
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center space-x-2">
                <button type="submit" class="w-full py-2.5 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-[10px] font-bold tracking-widest uppercase transition-colors">
                    TERAPKAN
                </button>
                @if($kategori || $tahun || $search)
                    <a href="{{ route('arsip.index') }}" class="py-2.5 px-3 bg-[#EAE6DF] hover:bg-[#DDD6C9] text-[#4A4A4A] text-[10px] font-bold tracking-widest uppercase transition-colors text-center">
                        RESET
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Penghitung Status Data -->
    <div class="flex items-center justify-between pb-4 border-b border-[#EAE6DF] mb-8 text-xs text-[#7A7770]">
        <span class="text-[11px] font-medium tracking-wider uppercase">
            MENAMPILKAN {{ $arsips->count() }} DARI {{ $totalSemua }} ARSIP
        </span>
    </div>

    <!-- Grid 3 Kolom per Baris -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
        @forelse($arsips as $item)
            @php
                $tahunItem = $item->tanggal_dokumentasi 
                    ? \Carbon\Carbon::parse($item->tanggal_dokumentasi)->format('Y') 
                    : ($item->periode_sejarah ? preg_replace('/[^0-9]/', '', $item->periode_sejarah) : date('Y'));
            @endphp
            <div class="flex flex-col justify-between group">
                <div>
                    <!-- Wadah Gambar dengan Label Tahun di Pojok Kanan Atas -->
                    <div class="relative aspect-square w-full bg-[#FAF9F7] border border-[#EAE6DF] p-6 flex items-center justify-center overflow-hidden">
                        <span class="absolute top-4 right-4 text-xs font-semibold text-[#8B6B3E]">
                            {{ $tahunItem ?: '2026' }}
                        </span>
                        
                        @if($item->foto_cover)
                            <img 
                                src="{{ $item->foto_cover }}" 
                                alt="{{ $item->nama_topeng }}" 
                                class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="text-center">
                                <span class="font-serif-celtic text-xs text-[#A89D88] uppercase tracking-widest">Aset Visual Kosong</span>
                            </div>
                        @endif
                    </div>

                    <!-- Kategori & Judul -->
                    <span class="text-[9px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block mt-5">
                        {{ $item->kategori ?: 'TAPEL WAYANG WONG' }}
                    </span>
                    <h3 class="font-serif-celtic text-2xl font-bold text-[#1E1E1E] mt-1 group-hover:text-[#5A0E0E] transition-colors">
                        {{ $item->nama_topeng }}
                    </h3>
                    <p class="text-xs text-[#666] mt-2 line-clamp-2 leading-relaxed">
                        {{ $item->deskripsi ?: 'Dokumentasi detail pelestarian tapel Wayang Wong sakral Desa Adat Talepud.' }}
                    </p>
                </div>

                <!-- Tautan ke Halaman Detail -->
                <a href="{{ route('arsip.show', $item->id_topeng) }}" class="text-[10px] font-bold tracking-[0.2em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase mt-6 inline-flex items-center">
                    LIHAT DETAIL &rarr;
                </a>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-xs text-[#8A8477] italic">
                Tidak ada data arsip yang sesuai dengan kriteria penyaringan.
            </div>
        @endforelse
    </div>

    <!-- Paginasi -->
    <div class="mt-14 flex justify-center">
        {{ $arsips->links() }}
    </div>

    <div class="text-center mt-12">
        <div class="inline-block p-1 text-[#8B6B3E] text-lg">&bull;</div>
    </div>
</div>
@endsection