@extends('layouts.admin')

@section('title', 'Sunting Topeng')
@section('header_title', 'Formulir Sunting Topeng')
@section('header_subtitle', 'PEMBARUAN METADATA DAN ASET DIGITAL')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white border border-[#EAE6DF] shadow-sm p-6 sm:p-8">
    <div class="mb-6 pb-4 border-b border-[#EAE6DF] flex justify-between items-center">
        <div>
            <h3 class="font-serif-celtic text-xl sm:text-2xl font-bold text-[#5A0E0E]">Perbarui: {{ $topeng->nama_topeng }}</h3>
            <p class="text-xs text-[#7A7770] mt-1">ID Koleksi: #TPG-{{ str_pad($topeng->id_topeng, 3, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('admin.topeng.index') }}" class="text-xs font-bold text-[#7A7770] hover:text-[#1E1E1E] uppercase tracking-wider">
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

    <form action="{{ route('admin.topeng.update', $topeng) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Identitas Koleksi -->
        <div class="border-b border-[#EAE6DF] pb-6 space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">1. Identitas Koleksi</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Nama Topeng *</label>
                    <input type="text" name="nama_topeng" value="{{ old('nama_topeng', $topeng->nama_topeng) }}" required class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                        <option value="Ratu Lingsir" {{ old('kategori', $topeng->kategori) == 'Ratu Lingsir' ? 'selected' : '' }}>Ratu Lingsir</option>
                        <option value="Ratu Anom" {{ old('kategori', $topeng->kategori) == 'Ratu Anom' ? 'selected' : '' }}>Ratu Anom</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Pencipta / Pembuat</label>
                    <input type="text" name="pencipta_pembuat" value="{{ old('pencipta_pembuat', $topeng->pencipta_pembuat) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Jenis Koleksi</label>
                    <input type="text" name="jenis_koleksi" value="{{ old('jenis_koleksi', $topeng->jenis_koleksi) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
            </div>
        </div>

        <!-- 2. Aset Digital -->
        <div class="border-b border-[#EAE6DF] pb-6 space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">2. Aset Digital</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Model 3D (.glb)</label>
                    <input type="file" name="model_3d" accept=".glb,.gltf" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-3 file:py-1 file:px-2.5 file:border-0 file:bg-[#5A0E0E] file:text-white file:text-xs">
                    @if($topeng->model_3d)
                        <span class="text-[10px] text-[#2D7738] mt-1 block truncate">Berkas saat ini: {{ basename($topeng->model_3d) }}</span>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Ganti Foto Cover</label>
                    <input type="file" name="foto_cover" accept="image/*" class="w-full p-2 bg-[#F4F2EE] border border-[#D5CFBE] text-xs file:mr-3 file:py-1 file:px-2.5 file:border-0 file:bg-[#5A0E0E] file:text-white file:text-xs">
                    @if($topeng->foto_cover)
                        <div class="mt-2 flex items-center space-x-2">
                            <img src="{{ $topeng->foto_cover }}" alt="{{ $topeng->nama_topeng }}" class="w-12 h-12 object-cover border border-[#EAE6DF]">
                            <span class="text-[10px] text-[#7A7770]">Foto saat ini aktif</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- 3. Narasi Filosofis & Budaya -->
        <div class="border-b border-[#EAE6DF] pb-6 space-y-4">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">3. Narasi Filosofis & Budaya</h4>
            <div>
                <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Deskripsi Umum</label>
                <textarea name="deskripsi" rows="3" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">{{ old('deskripsi', $topeng->deskripsi) }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Makna Filosofis</label>
                    <textarea name="makna_filosofis" rows="3" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">{{ old('makna_filosofis', $topeng->makna_filosofis) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Fungsi Pertunjukan</label>
                    <textarea name="fungsi_pertunjukan" rows="3" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">{{ old('fungsi_pertunjukan', $topeng->fungsi_pertunjukan) }}</textarea>
                </div>
            </div>
        </div>

        <!-- 4. Data Fisik & Pelestarian -->
        <div class="space-y-4 pb-2">
            <h4 class="text-xs font-bold uppercase tracking-widest text-[#8B6B3E]">4. Data Fisik & Pelestarian</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Bahan Pembuatan</label>
                    <input type="text" name="bahan_pembuatan" value="{{ old('bahan_pembuatan', $topeng->bahan_pembuatan) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Periode Sejarah</label>
                    <input type="text" name="periode_sejarah" value="{{ old('periode_sejarah', $topeng->periode_sejarah) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Kondisi Koleksi</label>
                    <input type="text" name="kondisi_koleksi" value="{{ old('kondisi_koleksi', $topeng->kondisi_koleksi) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan', $topeng->lokasi_penyimpanan) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Tanggal Dokumentasi</label>
                    <input type="date" name="tanggal_dokumentasi" value="{{ old('tanggal_dokumentasi', $topeng->tanggal_dokumentasi ? \Carbon\Carbon::parse($topeng->tanggal_dokumentasi)->format('Y-m-d') : '') }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-[#4A4A4A] mb-1">Petugas Dokumentasi</label>
                    <input type="text" name="petugas_dokumentasi" value="{{ old('petugas_dokumentasi', $topeng->petugas_dokumentasi) }}" class="w-full p-2.5 bg-[#F4F2EE] border border-[#D5CFBE] text-xs focus:outline-none focus:border-[#5A0E0E]">
                </div>
            </div>
        </div>

        <div class="pt-4 flex justify-end space-x-3 border-t border-[#EAE6DF]">
            <a href="{{ route('admin.topeng.index') }}" class="px-6 py-2.5 bg-[#EAE6DF] hover:bg-[#DDD8CF] text-xs font-bold uppercase tracking-widest text-[#4A4A4A] transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-[#5A0E0E] hover:bg-[#430A0A] text-white text-xs font-bold uppercase tracking-widest transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection