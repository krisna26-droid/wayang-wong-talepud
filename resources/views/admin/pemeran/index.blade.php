@extends('layouts.admin')

@section('title', 'Manajemen Pemeran')
@section('header_title', 'Seniman Pemeran')
@section('header_subtitle', 'BASIS DATA PENARI DAN MAESTRO')

@section('content')
<div class="w-full space-y-8">

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-800 text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6">
        <div class="max-w-2xl">
            <span class="text-[10px] font-bold tracking-[0.2em] text-[#8B6B3E] uppercase block mb-1">
                ARCHIVE MANAGEMENT
            </span>
            <h2 class="font-serif-celtic text-2xl sm:text-3xl md:text-4xl font-bold text-[#1E1E1E] leading-tight">
                Manajemen Pemeran
            </h2>
            <p class="text-xs text-[#555] mt-2 leading-relaxed">
                Kelola data seniman Wayang Wong Desa Talepud beserta karakter tarian yang diperankan.
            </p>
        </div>

        <div class="w-full sm:w-80 shrink-0 space-y-3">
            <form action="{{ route('admin.pemeran.index') }}" method="GET" class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8A8477]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari nama pemeran..." 
                    class="w-full pl-10 pr-3 py-2.5 bg-white border border-[#D5CFBE] text-xs text-[#1E1E1E] placeholder-[#8A8477] focus:outline-none focus:border-[#5A0E0E]"
                >
            </form>

            <a href="{{ route('admin.pemeran.create') }}" class="w-full py-3 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-[10px] font-bold tracking-[0.18em] uppercase transition-colors flex items-center justify-center space-x-2">
                <span class="text-base font-normal leading-none">+</span>
                <span>TAMBAH PEMERAN</span>
            </a>
        </div>
    </div>

    <!-- Header Kolom Desktop -->
    <div class="hidden md:flex pt-6 border-b border-[#EAE6DF] pb-3 items-center justify-between text-[10px] font-bold tracking-[0.18em] uppercase text-[#8A8477] px-6">
        <div class="w-[45%]">PEMERAN & PENGALAMAN</div>
        <div class="w-[35%]">KARAKTER DIKUASAI</div>
        <div class="w-[20%] text-right">AKSI</div>
    </div>

    <!-- Kartu Profil Dinamis -->
    <div class="space-y-4">
        @forelse($pemerans as $item)
            <div class="bg-white p-5 sm:p-6 border border-[#EAE6DF] flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-[#D5CFBE] transition-colors">
                <div class="w-full md:w-[45%] flex items-center space-x-4 sm:space-x-5">
                    <div class="w-14 sm:w-16 h-14 sm:h-16 shrink-0 flex items-center justify-center overflow-hidden border border-[#EAE6DF] bg-white">
                        @if($item->foto_pemeran)
                            <img src="{{ $item->foto_pemeran }}" alt="{{ $item->nama_pemeran }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-9 h-9 text-[#8A8477]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-serif-celtic text-lg font-bold text-[#5A0E0E] leading-tight truncate">
                            {{ $item->nama_pemeran }}
                        </h3>
                        <p class="text-[9px] font-bold tracking-wider text-[#8B6B3E] uppercase mt-1">
                            {{ $item->pengalaman ?? 'PEMERAN AKTIF' }}
                        </p>
                        <p class="text-xs text-[#6A6A6A] mt-1 truncate">
                            {{ $item->biodata_singkat ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-[35%] flex flex-wrap gap-2 md:px-2">
                    @forelse($item->karakters as $karakter)
                        <span class="px-2.5 py-1 bg-[#EAE6DF] text-[#4A4A4A] text-[9px] font-bold tracking-wider uppercase">
                            {{ $karakter->nama_karakter }}
                        </span>
                    @empty
                        <span class="text-xs text-[#8A8477] italic">Belum ada karakter yang dikaitkan</span>
                    @endforelse
                </div>

                <div class="w-full md:w-[20%] flex items-center justify-end space-x-4 text-xs font-bold tracking-wider uppercase text-[#1E1E1E] pt-2 md:pt-0 border-t md:border-t-0 border-[#EAE6DF]">
                    <a href="{{ route('admin.pemeran.edit', $item) }}" class="inline-flex items-center hover:text-[#5A0E0E]">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        EDIT
                    </a>
                    <form action="{{ route('admin.pemeran.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus profil pemeran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center hover:text-red-700">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            HAPUS
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 bg-white border border-[#EAE6DF] text-center text-xs text-[#8A8477] italic">
                Belum ada data seniman pemeran tersimpan.
            </div>
        @endforelse
    </div>

    <div class="pt-4">
        {{ $pemerans->links() }}
    </div>
</div>
@endsection