@extends('layouts.admin')

@section('title', 'Sunting Arsip Budaya')
@section('header_title', 'Formulir Sunting Arsip')
@section('header_subtitle', 'PEMBARUAN DOKUMENTASI & MEDIA')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white border border-[#EAE6DF] shadow-sm p-6 sm:p-8">
    <div class="mb-6 pb-4 border-b border-[#EAE6DF] flex justify-between items-center">
        <div>
            <h3 class="font-serif-celtic text-xl sm:text-2xl font-bold text-[#5A0E0E]">Perbarui: {{ $arsip->judul_arsip }}</h3>
            <p class="text-xs text-[#7A7770] mt-1">ID Arsip: #ARS-{{ str_pad($arsip->id_arsip, 3, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('admin.arsip.index') }}" class="text-xs font-bold text-[#7A7770] hover:text-[#1E1E1E] uppercase tracking-wider">
            &larr; Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.arsip.update', $arsip) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Metadata Utama -->
        <div class="border-b border-[#EAE6DF] pb-6 space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">1. Metadata Utama</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Judul Arsip *</label>
                    <input type="text" name="judul_arsip" value="{{ old('judul_arsip', $arsip->judul_arsip) }}" required class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Kategori Arsip *</label>
                    <select name="kategori" required class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                        <option value="Artefak Fisik" {{ old('kategori', $arsip->kategori) == 'Artefak Fisik' ? 'selected' : '' }}>Artefak Fisik</option>
                        <option value="Multimedia" {{ old('kategori', $arsip->kategori) == 'Multimedia' ? 'selected' : '' }}>Multimedia (Audio/Video)</option>
                        <option value="Literatur" {{ old('kategori', $arsip->kategori) == 'Literatur' ? 'selected' : '' }}>Literatur / Naskah Kuno</option>
                        <option value="Dokumentasi Pertunjukan" {{ old('kategori', $arsip->kategori) == 'Dokumentasi Pertunjukan' ? 'selected' : '' }}>Dokumentasi Pertunjukan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Tahun Dokumentasi</label>
                    <input type="number" name="tahun_dokumentasi" value="{{ old('tahun_dokumentasi', $arsip->tahun_dokumentasi) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
            </div>
        </div>

        <!-- 2. Berkas Media -->
        <div class="border-b border-[#EAE6DF] pb-6 space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">2. Berkas Media</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Thumbnail / Sampul</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-3 file:py-1 file:px-2.5 file:border-0 file:bg-[#5A0E0E] file:text-white file:text-xs">
                    @if($arsip->thumbnail)
                        <div class="mt-2 flex items-center space-x-2">
                            <img src="{{ $arsip->thumbnail }}" alt="{{ $arsip->judul_arsip }}" class="w-12 h-12 object-cover border border-[#EAE6DF]">
                            <span class="text-[10px] text-[#7A7770]">Thumbnail aktif</span>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Berkas Media Utama</label>
                    <input type="file" name="file_media" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-3 file:py-1 file:px-2.5 file:border-0 file:bg-[#5A0E0E] file:text-white file:text-xs">
                    @if($arsip->file_media)
                        <a href="{{ $arsip->file_media }}" target="_blank" class="text-[10px] text-[#5A0E0E] underline mt-2 inline-block truncate max-w-full">
                            Berkas tersimpan saat ini &nearr;
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- 3. Deskripsi -->
        <div class="space-y-4 pb-2">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">3. Deskripsi & Catatan Kontekstual</h4>
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Deskripsi Lengkap</label>
                <textarea name="deskripsi" rows="4" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">{{ old('deskripsi', $arsip->deskripsi) }}</textarea>
            </div>
        </div>

        <div class="pt-4 flex justify-end space-x-3 border-t border-[#EAE6DF]">
            <a href="{{ route('admin.arsip.index') }}" class="px-6 py-2.5 bg-[#EAE6DF] hover:bg-[#DDD8CF] text-xs font-bold uppercase tracking-widest text-[#4A4A4A] transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-xs font-bold uppercase tracking-widest transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection