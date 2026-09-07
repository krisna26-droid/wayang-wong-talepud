@extends('layouts.admin')

@section('title', 'Manajemen Koleksi Topeng')
@section('header_title', 'Koleksi Topeng')
@section('header_subtitle', 'INVENTARIS DAN DIGITALISASI 3D')

@section('content')
<div class="w-full space-y-8 lg:space-y-10">

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-800 text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-serif-celtic text-2xl sm:text-3xl md:text-4xl font-bold text-[#5A0E0E] leading-tight">
                Manajemen Koleksi Topeng
            </h2>
            <p class="text-xs text-[#555] mt-1">
                Daftar inventaris topeng sakral dan koleksi pertunjukan Wayang Wong.
            </p>
        </div>

        <form action="{{ route('admin.topeng.index') }}" method="GET" class="w-full sm:w-80 lg:w-96">
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A7770]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari nama atau jenis topeng..." 
                    class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#D5CFBE] text-xs text-[#1E1E1E] placeholder-[#7A7770] focus:outline-none focus:border-[#5A0E0E]"
                >
            </div>
        </form>
    </div>

    <!-- Metrik -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
        <div class="md:col-span-7 bg-[#F4F2EE] border border-[#EAE6DF] p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8 items-center">
            <div>
                <span class="text-[10px] font-bold tracking-[0.15em] text-[#7A7770] uppercase block mb-2 sm:mb-3">
                    TOTAL KOLEKSI AKTIF
                </span>
                <div class="flex items-baseline space-x-3">
                    <span class="font-serif-celtic text-4xl sm:text-5xl font-bold text-[#1E1E1E] leading-none">
                        {{ $totalKoleksi }}
                    </span>
                    <span class="text-xs text-[#7A7770]">Item</span>
                </div>
            </div>

            <div class="sm:border-l border-t sm:border-t-0 pt-4 sm:pt-0 sm:pl-8 border-[#DCD6CA]">
                <span class="text-[10px] font-bold tracking-[0.15em] text-[#7A7770] uppercase block mb-2 sm:mb-3">
                    MODEL 3D TERSEDIA
                </span>
                <div class="flex items-baseline space-x-3">
                    <span class="font-serif-celtic text-4xl sm:text-5xl font-bold text-[#1E1E1E] leading-none">
                        {{ $totalModel3D }}
                    </span>
                    <span class="text-xs text-[#7A7770]">Digitalized</span>
                </div>
            </div>
        </div>

        <div class="md:col-span-5 bg-[#5A0E0E] text-white p-6 sm:p-8 flex flex-col justify-center">
            <span class="text-[9px] font-bold tracking-[0.2em] text-[#E0C0C0] uppercase block mb-2">
                UPDATE TERAKHIR
            </span>
            <h3 class="font-serif-celtic text-2xl sm:text-3xl font-bold mb-1 text-[#FDFBF7]">
                {{ $updateTerakhir ? $updateTerakhir->updated_at->locale('id')->isoFormat('D MMMM Y') : '-' }}
            </h3>
            <p class="text-xs text-[#E6D4D4]">
                {{ $updateTerakhir ? 'Koleksi: ' . $updateTerakhir->nama_topeng : 'Belum ada rekaman' }}
            </p>
        </div>
    </div>

    <!-- Tabel Data Dinamis -->
    <div class="pt-2">
        <div class="overflow-x-auto border-b border-[#EAE6DF]">
            <table class="w-full min-w-[700px] text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-bold tracking-[0.18em] uppercase text-[#8A8477] border-b border-[#EAE6DF]">
                        <th class="py-3 px-3 w-16">NO.</th>
                        <th class="py-3 px-6">NAMA TOPENG</th>
                        <th class="py-3 px-6 w-48">KATEGORI</th>
                        <th class="py-3 px-6 w-52">STATUS 3D MODEL</th>
                        <th class="py-3 px-4 w-28 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EAE6DF] text-xs">
                    @forelse($topengs as $index => $item)
                        <tr class="hover:bg-[#FAF9F7]/70 transition-colors">
                            <td class="py-5 px-3 font-mono text-[#8A8477]">
                                {{ str_pad($topengs->firstItem() + $index, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-5 px-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-[#2B231D] shrink-0 border border-[#EAE6DF] overflow-hidden">
                                        @if($item->foto_cover)
                                            <img src="{{ $item->foto_cover }}" alt="{{ $item->nama_topeng }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-[#A89D88]">N/A</div>
                                        @endif
                                    </div>
                                    <span class="font-bold text-sm text-[#1E1E1E]">{{ $item->nama_topeng }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-[#555]">
                                {{ $item->kategori }}
                            </td>
                            <td class="py-5 px-6">
                                @if($item->model_3d)
                                    <span class="px-3 py-1 text-[9px] font-bold tracking-widest uppercase rounded-full bg-[#EAE6DF] text-[#4A4A4A]">
                                        TERSEDIA (.GLB)
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-[9px] font-bold tracking-widest uppercase rounded-full bg-[#F5EFE6] text-[#A6947D]">
                                        BELUM TERSEDIA
                                    </span>
                                @endif
                            </td>
                            <td class="py-5 px-4 text-right">
                                <div class="flex items-center justify-end space-x-3 text-[#555]">
                                    <a href="{{ route('admin.topeng.edit', $item) }}" class="hover:text-[#5A0E0E]" title="Sunting">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.topeng.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus koleksi topeng ini secara permanen?')">
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
                            <td colspan="5" class="py-8 text-center text-xs text-[#8A8477] italic">Tidak ada koleksi topeng yang cocok dengan pencarian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $topengs->links() }}
        </div>
    </div>
</div>
@endsection