@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Ringkasan Sistem')
@section('header_subtitle', 'PANEL KONTROL ARSIP & DIGITALISASI BUDAYA')

@section('content')
<div class="space-y-8">
    <!-- Grid Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-6 border border-[#EAE6DF] flex flex-col justify-between">
            <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase">TOTAL TOPENG</span>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#5A0E0E]">{{ $totalTopeng }}</span>
                <a href="{{ route('admin.topeng.index') }}" class="text-[11px] font-semibold text-[#8B6B3E] hover:underline">Kelola &rarr;</a>
            </div>
        </div>

        <div class="bg-white p-6 border border-[#EAE6DF] flex flex-col justify-between">
            <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase">ARSIP DOKUMENTASI</span>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">{{ $totalArsip }}</span>
                <a href="{{ route('admin.arsip.index') }}" class="text-[11px] font-semibold text-[#8B6B3E] hover:underline">Kelola &rarr;</a>
            </div>
        </div>

        <div class="bg-white p-6 border border-[#EAE6DF] flex flex-col justify-between">
            <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase">TOKOH KARAKTER</span>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">{{ $totalKarakter }}</span>
                <a href="{{ route('admin.karakter.index') }}" class="text-[11px] font-semibold text-[#8B6B3E] hover:underline">Kelola &rarr;</a>
            </div>
        </div>

        <div class="bg-white p-6 border border-[#EAE6DF] flex flex-col justify-between">
            <span class="text-[10px] font-bold tracking-widest text-[#8A8477] uppercase">SENIMAN PEMERAN</span>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#1E1E1E]">{{ $totalPemeran }}</span>
                <a href="{{ route('admin.pemeran.index') }}" class="text-[11px] font-semibold text-[#8B6B3E] hover:underline">Kelola &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Grid Data Koleksi Terbaru & Arsip Terkini -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Tabel Topeng Terbaru -->
        <div class="lg:col-span-7 bg-white border border-[#EAE6DF] p-6">
            <div class="flex items-center justify-between pb-4 border-b border-[#EAE6DF]">
                <div>
                    <h3 class="font-serif-celtic text-lg font-bold text-[#5A0E0E]">Topeng Terdaftar Baru</h3>
                    <p class="text-xs text-[#7A7770]">Inventaris koleksi digital terkini.</p>
                </div>
                <a href="{{ route('admin.topeng.create') }}" class="text-xs font-bold text-[#5A0E0E] hover:underline uppercase tracking-wider">+ Tambah</a>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="text-[10px] font-bold tracking-wider uppercase text-[#8A8477] border-b border-[#EAE6DF]">
                            <th class="py-2.5 px-3">COVER</th>
                            <th class="py-2.5 px-3">NAMA</th>
                            <th class="py-2.5 px-3">KATEGORI</th>
                            <th class="py-2.5 px-3 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EAE6DF]">
                        @forelse($topengTerbaru as $topeng)
                            <tr class="hover:bg-[#FAF9F7]">
                                <td class="py-3 px-3">
                                    <div class="w-10 h-10 bg-[#EAE6DF] border border-[#D5CFBE] overflow-hidden">
                                        @if($topeng->foto_cover)
                                            <img src="{{ $topeng->foto_cover }}" alt="{{ $topeng->nama_topeng }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[9px] font-bold text-[#8A8477]">N/A</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-3 font-semibold text-[#1E1E1E]">{{ $topeng->nama_topeng }}</td>
                                <td class="py-3 px-3 text-[#7A7770]">{{ $topeng->kategori }}</td>
                                <td class="py-3 px-3 text-right">
                                    <a href="{{ route('admin.topeng.edit', $topeng) }}" class="text-xs font-bold text-[#5A0E0E] hover:underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-xs text-[#8A8477] italic">Belum ada data topeng tersimpan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Arsip Terbaru -->
        <div class="lg:col-span-5 bg-white border border-[#EAE6DF] p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-[#EAE6DF]">
                    <h3 class="font-serif-celtic text-lg font-bold text-[#1E1E1E]">Arsip Terbaru</h3>
                    <a href="{{ route('admin.arsip.create') }}" class="text-xs font-bold text-[#5A0E0E] hover:underline uppercase tracking-wider">+ Tambah</a>
                </div>

                <div class="divide-y divide-[#EAE6DF] mt-3">
                    @forelse($arsipTerbaru as $arsip)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-[#1E1E1E]">{{ $arsip->judul_arsip }}</p>
                                <span class="text-[10px] text-[#8A8477] uppercase">{{ $arsip->kategori }} &bull; {{ $arsip->tahun_dokumentasi ?? '-' }}</span>
                            </div>
                            <a href="{{ route('admin.arsip.edit', $arsip) }}" class="text-xs font-bold text-[#8A8477] hover:text-[#5A0E0E]">Edit</a>
                        </div>
                    @empty
                        <p class="py-6 text-center text-xs text-[#8A8477] italic">Belum ada dokumentasi arsip tersimpan.</p>
                    @endforelse
                </div>
            </div>
            <a href="{{ route('admin.arsip.index') }}" class="block w-full py-2.5 text-center text-xs font-bold uppercase tracking-wider bg-[#F4F2EE] hover:bg-[#EAE6DF] text-[#4A4A4A] mt-4 transition-colors">
                Lihat Semua Arsip &rarr;
            </a>
        </div>
    </div>
</div>
@endsection