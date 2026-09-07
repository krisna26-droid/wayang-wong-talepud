@extends('layouts.admin')

@section('title', 'Sunting Seniman Pemeran')
@section('header_title', 'Formulir Sunting Pemeran')
@section('header_subtitle', 'PEMBARUAN RIWAYAT MAESTRO')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white border border-[#EAE6DF] p-6 sm:p-8">
    <div class="mb-6 pb-4 border-b border-[#EAE6DF] flex justify-between items-center">
        <div>
            <h3 class="font-serif-celtic text-xl sm:text-2xl font-bold text-[#5A0E0E]">Perbarui: {{ $pemeran->nama_pemeran }}</h3>
            <p class="text-xs text-[#7A7770] mt-1">ID Pemeran: #{{ $pemeran->id_pemeran }}</p>
        </div>
        <a href="{{ route('admin.pemeran.index') }}" class="text-xs font-bold text-[#7A7770] hover:text-[#1E1E1E] uppercase tracking-wider">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.pemeran.update', $pemeran) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Nama Seniman Pemeran *</label>
                <input type="text" name="nama_pemeran" value="{{ old('nama_pemeran', $pemeran->nama_pemeran) }}" required class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Status / Lama Pengalaman</label>
                <input type="text" name="pengalaman" value="{{ old('pengalaman', $pemeran->pengalaman) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
            </div>
        </div>

        <div class="border-t border-[#EAE6DF] pt-4">
            <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-2">Karakter yang Dikuasai</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 bg-[#F8F7F4] p-3 border border-[#D5CFBE] max-h-48 overflow-y-auto">
                @foreach($karakters as $k)
                    <label class="inline-flex items-center space-x-2 text-xs text-[#1E1E1E]">
                        <input type="checkbox" name="karakter_ids[]" value="{{ $k->id_karakter }}" {{ in_array($k->id_karakter, $selectedKarakters) ? 'checked' : '' }} class="rounded text-[#5A0E0E] focus:ring-0">
                        <span>{{ $k->nama_karakter }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="border-t border-[#EAE6DF] pt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Foto Portret</label>
                <input type="file" name="foto_pemeran" accept="image/*" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-2 file:py-1 file:px-2 file:border-0 file:bg-[#5A0E0E] file:text-white">
                @if($pemeran->foto_pemeran)
                    <img src="{{ $pemeran->foto_pemeran }}" alt="{{ $pemeran->nama_pemeran }}" class="w-12 h-12 object-cover border border-[#EAE6DF] mt-2">
                @endif
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Tautan Video Pentas (YouTube)</label>
                <input type="url" name="video_youtube" value="{{ old('video_youtube', $pemeran->video_youtube) }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
            </div>
        </div>

        <div class="border-t border-[#EAE6DF] pt-4">
            <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Biodata Singkat & Pengabdian</label>
            <textarea name="biodata_singkat" rows="4" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">{{ old('biodata_singkat', $pemeran->biodata_singkat) }}</textarea>
        </div>

        <div class="pt-4 flex justify-end space-x-3 border-t border-[#EAE6DF]">
            <a href="{{ route('admin.pemeran.index') }}" class="px-6 py-2.5 bg-[#EAE6DF] text-xs font-bold uppercase tracking-widest text-[#4A4A4A]">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-[#5A0E0E] text-white text-xs font-bold uppercase tracking-widest hover:bg-[#430A0A]">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection