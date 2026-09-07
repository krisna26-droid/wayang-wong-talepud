@extends('layouts.admin')

@section('title', 'Manajemen Karakter')
@section('header_title', 'Tokoh Karakter')
@section('header_subtitle', 'PROFIL NARATIF DAN AUDIO PERAN')

@section('content')
<div class="w-full space-y-8 lg:space-y-10">

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-800 text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
        <div>
            <h2 class="font-serif-celtic text-2xl sm:text-3xl md:text-4xl font-bold text-[#5A0E0E] tracking-wide">
                Manajemen Karakter
            </h2>
            <p class="text-xs text-[#6A6A6A] mt-2 max-w-2xl leading-relaxed">
                Kelola daftar tokoh Wayang Wong, detail audio dialog, deskripsi peran, dan relasi sakral dengan koleksi topeng.
            </p>
        </div>

        <div class="w-full sm:w-auto flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <form action="{{ route('admin.karakter.index') }}" method="GET" class="w-full sm:w-64">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari karakter / peran..." 
                    class="w-full px-3 py-2 bg-white border border-[#D5CFBE] text-xs text-[#1E1E1E] placeholder-[#8A8477] focus:outline-none focus:border-[#5A0E0E]"
                >
            </form>
            <a href="{{ route('admin.karakter.create') }}" class="px-4 py-2.5 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-[10px] font-bold tracking-widest uppercase text-center">
                + Tambah Karakter
            </a>
        </div>
    </div>

    <!-- Metrik Karakter -->
    <div class="border border-[#EAE6DF] bg-white grid grid-cols-1 sm:grid-cols-2">
        <div class="p-6 sm:p-8 sm:border-r border-b sm:border-b-0 border-[#EAE6DF]">
            <span class="text-[10px] font-bold tracking-[0.18em] text-[#7A7770] uppercase block mb-2 sm:mb-3">TOTAL TOKOH</span>
            <span class="font-serif-celtic text-4xl sm:text-5xl font-bold text-[#1E1E1E] leading-none">{{ $totalKarakter }}</span>
        </div>
        <div class="p-6 sm:p-8">
            <span class="text-[10px] font-bold tracking-[0.18em] text-[#7A7770] uppercase block mb-2 sm:mb-3">VARIASI PERAN AKTIF</span>
            <span class="font-serif-celtic text-4xl sm:text-5xl font-bold text-[#1E1E1E] leading-none">{{ $peranAktif }}</span>
        </div>
    </div>

    <!-- Tabel Responsif Karakter -->
    <div class="pt-2">
        <div class="overflow-x-auto border-b border-[#EAE6DF]">
            <table class="w-full min-w-[650px] text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-bold tracking-[0.18em] uppercase text-[#8A8477] border-b border-[#EAE6DF]">
                        <th class="py-3 px-3 w-20">VISUAL</th>
                        <th class="py-3 px-6">NAMA KARAKTER</th>
                        <th class="py-3 px-6 w-44 text-center">PERAN UTAMA</th>
                        <th class="py-3 px-6 w-44 text-center">AUDIO / DIALOG</th>
                        <th class="py-3 px-4 w-28 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EAE6DF] text-xs">
                    @forelse($karakters as $item)
                        <tr class="hover:bg-[#FAF9F7]/70 transition-colors">
                            <td class="py-5 px-3">
                                <div class="w-14 h-14 bg-[#2B231D] shrink-0 border border-[#EAE6DF] overflow-hidden">
                                    @if($item->visual_karakter)
                                        <img src="{{ $item->visual_karakter }}" alt="{{ $item->nama_karakter }}" class="w-full h-full object-cover">
                                    @elseif($item->topeng && $item->topeng->foto_cover)
                                        <img src="{{ $item->topeng->foto_cover }}" alt="{{ $item->nama_karakter }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-[#A89D88]">N/A</div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-5 px-6">
                                <p class="font-serif-celtic font-bold text-base text-[#1E1E1E] leading-tight">
                                    {{ $item->nama_karakter }}
                                </p>
                                @if($item->topeng)
                                    <span class="text-[10px] text-[#8B6B3E] font-medium block mt-0.5">Topeng: {{ $item->topeng->nama_topeng }}</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-center">
                                <span class="inline-block px-3 py-1 text-[9px] font-bold tracking-widest uppercase bg-[#EAE6DF] text-[#4A4A4A]">
                                    {{ $item->peran ?? 'UMUM' }}
                                </span>
                            </td>
                            <td class="py-5 px-6 text-center">
                                @if($item->audio_karakter)
                                    <audio controls class="h-7 w-44 mx-auto">
                                        <source src="{{ $item->audio_karakter }}" type="audio/mpeg">
                                    </audio>
                                @else
                                    <span class="text-xs text-[#8A8477] italic">Tanpa Audio</span>
                                @endif
                            </td>
                            <td class="py-5 px-4 text-right">
                                <div class="inline-flex items-center space-x-3 text-[#555]">
                                    <a href="{{ route('admin.karakter.edit', $item) }}" class="hover:text-[#5A0E0E]" title="Sunting">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.karakter.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus karakter ini?')">
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
                            <td colspan="5" class="py-8 text-center text-xs text-[#8A8477] italic">Belum ada data karakter terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $karakters->links() }}
        </div>
    </div>
</div>
@endsection