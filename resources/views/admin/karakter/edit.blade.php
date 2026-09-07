@extends('layouts.admin')

@section('title', 'Sunting Karakter')
@section('header_title', 'Formulir Sunting Karakter')
@section('header_subtitle', 'PEMBARUAN PROFIL TOKOH')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white border border-[#EAE6DF] p-6 sm:p-8">
    <div class="mb-6 pb-4 border-b border-[#EAE6DF] flex justify-between items-center">
        <div>
            <h3 class="font-serif-celtic text-xl sm:text-2xl font-bold text-[#5A0E0E]">Perbarui: {{ $karakter->nama_karakter }}</h3>
            <p class="text-xs text-[#7A7770] mt-1">ID Karakter: #{{ $karakter->id_karakter }}</p>
        </div>
        <a href="{{ route('admin.karakter.index') }}" class="text-xs font-bold text-[#7A7770] hover:text-[#1E1E1E] uppercase tracking-wider">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.karakter.update', $karakter) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Nama Tokoh Karakter *</label>
                <input type="text" name="nama_karakter" value="{{ old('nama_karakter', $karakter->nama_karakter) }}" required class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Peran / Watak</label>
                <input type="text" name="peran" value="{{ old('peran', $karakter->peran) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Topeng Terkait</label>
                <select name="id_topeng" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                    <option value="">-- Tanpa Relasi Topeng Spesifik --</option>
                    @foreach($topengs as $t)
                        <option value="{{ $t->id_topeng }}" {{ old('id_topeng', $karakter->id_topeng) == $t->id_topeng ? 'selected' : '' }}>{{ $t->nama_topeng }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="border-t border-[#EAE6DF] pt-4 space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">Aset Multimedia</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Foto Visual</label>
                    <input type="file" name="visual_karakter" accept="image/*" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-2 file:py-1 file:px-2 file:border-0 file:bg-[#5A0E0E] file:text-white">
                    @if($karakter->visual_karakter)
                        <img src="{{ $karakter->visual_karakter }}" alt="{{ $karakter->nama_karakter }}" class="w-12 h-12 object-cover border border-[#EAE6DF] mt-2">
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Berkas Audio</label>
                    <input type="file" name="audio_karakter" accept="audio/*" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-2 file:py-1 file:px-2 file:border-0 file:bg-[#5A0E0E] file:text-white">
                    @if($karakter->audio_karakter)
                        <audio controls class="h-6 w-full mt-2">
                            <source src="{{ $karakter->audio_karakter }}" type="audio/mpeg">
                        </audio>
                    @endif
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Tautan Video Cuplikan Solah Tari (YouTube)</label>
                <input type="url" name="video_youtube" value="{{ old('video_youtube', $karakter->video_youtube) }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                @if($karakter->youtube_embed_url)
                    <div class="mt-2 aspect-video w-56 border border-[#D5CFBE]">
                        <iframe src="{{ $karakter->youtube_embed_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif
            </div>
        </div>

        <div class="border-t border-[#EAE6DF] pt-4">
            <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Deskripsi Naratif</label>
            <textarea name="deskripsi" rows="4" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">{{ old('deskripsi', $karakter->deskripsi) }}</textarea>
        </div>

        <div class="pt-4 flex justify-end space-x-3 border-t border-[#EAE6DF]">
            <a href="{{ route('admin.karakter.index') }}" class="px-6 py-2.5 bg-[#EAE6DF] text-xs font-bold uppercase tracking-widest text-[#4A4A4A]">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-[#5A0E0E] text-white text-xs font-bold uppercase tracking-widest hover:bg-[#430A0A]">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection