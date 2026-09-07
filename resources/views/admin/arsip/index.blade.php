@extends('layouts.admin')

@section('title', 'Katalog Arsip Budaya')
@section('header_title', 'Arsip Budaya')
@section('header_subtitle', 'REKAMAN MULTIMEDIA & LITERATUR')

@section('content')
<div class="w-full space-y-8 lg:space-y-10">

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-800 text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <span class="text-[10px] font-bold tracking-[0.2em] text-[#8A8477] uppercase block mb-1">
                DOCUMENTATION HUB
            </span>
            <h2 class="font-serif-celtic text-2xl sm:text-3xl md:text-4xl font-bold text-[#1E1E1E] leading-none inline-block relative pb-2.5">
                Katalog Arsip Budaya
                <span class="absolute bottom-0 left-0 w-24 h-[3px] bg-[#B08A4E]"></span>
            </h2>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <form action="{{ route('admin.arsip.index') }}" method="GET" class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#A0988A]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari dokumentasi..." 
                    class="w-full sm:w-60 pl-10 pr-3 py-2.5 bg-white border border-[#D5CFBE] text-xs text-[#1E1E1E] placeholder-[#A0988A] focus:outline-none focus:border-[#5A0E0E]"
                >
            </form>

            <a href="{{ route('admin.arsip.create') }}" class="px-5 py-2.5 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-[10px] font-bold tracking-[0.15em] uppercase transition-colors flex items-center justify-center shrink-0">
                <span class="text-sm mr-1.5 leading-none font-normal">+</span> TAMBAH ARSIP BARU
            </a>
        </div>
    </div>

    <!-- Metrik Arsip -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
        <div class="md:col-span-3 bg-white p-6 sm:p-7 border border-[#EAE6DF] flex flex-col justify-between h-40 sm:h-48">
            <span class="text-[10px] font-bold tracking-[0.15em] text-[#7A7770] uppercase">TOTAL ARSIP</span>
            <div>
                <span class="font-serif-celtic text-4xl sm:text-5xl font-bold text-[#5A0E0E] leading-none">{{ $totalKoleksi }}</span>
                <span class="text-xs text-[#7A7770] ml-1 font-normal">Items</span>
            </div>
        </div>

        <div class="md:col-span-3 bg-white p-6 sm:p-7 border border-[#EAE6DF] flex flex-col justify-between h-40 sm:h-48">
            <span class="text-[10px] font-bold tracking-[0.15em] text-[#7A7770] uppercase">DIGITALISASI BULAN INI</span>
            <div>
                <span class="font-serif-celtic text-4xl sm:text-5xl font-bold text-[#8B6B3E] leading-none">+{{ $digitalisasiBulanIni }}</span>
                <span class="text-xs text-[#7A7770] ml-1 font-normal">Tersimpan</span>
            </div>
        </div>

        <div class="md:col-span-6 bg-[#5A0E0E] text-white p-6 sm:p-8 flex flex-col justify-center min-h-[160px] sm:h-48">
            <h3 class="font-serif-celtic text-xl sm:text-2xl font-bold mb-2 text-[#FDFBF7]">
                Pelestarian Warisan Wayang Wong
            </h3>
            <p class="text-xs text-[#E6D4D4] leading-relaxed max-w-lg">
                Basis data arsip terhubung langsung ke Supabase Storage untuk menjaga keaslian visual, literatur, dan audio rekaman adat.
            </p>
        </div>
    </div>

    <!-- Tabel Data Arsip Dinamis -->
    <div class="pt-2">
        <div class="overflow-x-auto border-b border-[#EAE6DF]">
            <table class="w-full min-w-[700px] text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-bold tracking-[0.18em] uppercase text-[#8A8477] border-b border-[#EAE6DF]">
                        <th class="py-3 px-3 w-16">ID</th>
                        <th class="py-3 px-6">JUDUL ARSIP</th>
                        <th class="py-3 px-6 w-44">KATEGORI</th>
                        <th class="py-3 px-6 w-28">TAHUN</th>
                        <th class="py-3 px-6 w-36">MEDIA</th>
                        <th class="py-3 px-4 w-28 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EAE6DF] text-xs">
                    @forelse($arsips as $item)
                        <tr class="hover:bg-[#FAF9F7]/70 transition-colors">
                            <td class="py-4 px-3 font-mono text-[#8A8477]">
                                #{{ str_pad($item->id_arsip, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-[#1E1E1E] shrink-0 overflow-hidden border border-[#EAE6DF]">
                                        @if($item->thumbnail || $item->file_media)
                                            <img src="{{ $item->thumbnail ?: $item->file_media }}" alt="{{ $item->judul_arsip }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-[#A89D88]">N/A</div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-serif-celtic font-bold text-sm text-[#1E1E1E]">{{ $item->judul_arsip }}</p>
                                        <p class="text-[11px] text-[#7A7770]">{{ Str::limit($item->deskripsi, 45) ?? 'Tidak ada catatan deskripsi' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 text-[9px] font-bold tracking-widest uppercase bg-[#EAE6DF] text-[#4A4A4A]">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-[#555]">
                                {{ $item->tahun_dokumentasi ?? '-' }}
                            </td>
                            <td class="py-4 px-6">
                                @if($item->file_media)
                                    <a href="{{ $item->file_media }}" target="_blank" class="text-xs text-[#5A0E0E] underline font-medium">Buka Berkas &nearr;</a>
                                @else
                                    <span class="text-xs text-[#8A8477] italic">Tanpa Berkas</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end space-x-3 text-[#555]">
                                    <a href="{{ route('admin.arsip.edit', $item) }}" class="hover:text-[#5A0E0E]" title="Sunting">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.arsip.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus arsip ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-700" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-[#8A8477] italic">Tidak ada arsip dokumentasi ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $arsips->links() }}
        </div>
    </div>
</div>
@endsection