@extends('layouts.app')

@section('title', 'Koleksi Topeng Sakral')

@section('content')
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>

<style>
    /* Titik Hotspot Putih Bersinar */
    .pin-pulse {
        width: 16px;
        height: 16px;
        background-color: #ffffff;
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.35), 0 0 15px rgba(255, 255, 255, 0.8);
        cursor: pointer;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }
    .pin-pulse:hover {
        transform: scale(1.3);
        background-color: #FAF8F5;
        box-shadow: 0 0 0 6px rgba(255, 255, 255, 0.5), 0 0 20px rgba(255, 255, 255, 1);
    }

    /* Kotak Informasi Putih Minimalis Sesuai Desain */
    .info-box-card {
        background: #ffffff;
        color: #1a1a1a;
        padding: 12px 16px;
        border-radius: 1px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.7);
        width: 230px;
        pointer-events: auto;
        border-left: 3px solid #5A0E0E;
    }
</style>

@php
    $firstTopeng = $semuaTopeng->first();
@endphp

<!-- 1. Interactive 3D Showcase Section -->
<section class="w-full bg-[#121212] text-white min-h-[750px] relative flex flex-col justify-between overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 py-12 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center flex-1">
        
        <!-- Informasi Kiri Topeng -->
        <div class="lg:col-span-4 z-10 space-y-6">
            <h1 id="activeName" class="font-serif-celtic text-4xl sm:text-6xl font-bold tracking-tight text-[#FAF8F5]">
                {{ $firstTopeng?->nama_topeng ?? 'Koleksi Topeng' }}
            </h1>

            <p id="activeFilosofis" class="font-serif-quote italic text-sm sm:text-base text-[#C4BEB4] leading-relaxed">
                @if($firstTopeng?->makna_filosofis)
                    &ldquo;{{ $firstTopeng->makna_filosofis }}&rdquo;
                @else
                    &ldquo;{{ $firstTopeng?->deskripsi ?? 'Warisan seni pertunjukan sakral yang melambangkan kesucian dan dedikasi spiritual leluhur.' }}&rdquo;
                @endif
            </p>

            <div class="pt-4 border-t border-[#2E2E2E] grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block mb-1">KATEGORI</span>
                    <span id="activeKategori" class="font-medium text-[#DDD]">{{ $firstTopeng?->kategori ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#8B6B3E] block mb-1">MATERIAL</span>
                    <span id="activeMaterial" class="font-medium text-[#DDD]">{{ $firstTopeng?->bahan_pembuatan ?? '-' }}</span>
                </div>
            </div>

            <!-- Pemilih Topeng Cepat -->
            <div class="pt-4">
                <span class="text-[9px] font-bold tracking-widest uppercase text-[#888] block mb-2">PILIH TAPEL</span>
                <div class="flex space-x-2 overflow-x-auto pb-2">
                    @forelse($semuaTopeng as $index => $t)
                        <button 
                            type="button" 
                            onclick="switchTopeng({{ $index }})" 
                            class="w-12 h-12 shrink-0 border border-[#333] hover:border-[#8B6B3E] focus:border-[#FAF8F5] transition-all bg-[#1E1E1E] p-1 overflow-hidden"
                            title="{{ $t->nama_topeng }}"
                        >
                            @if($t->foto_cover)
                                <img src="{{ $t->foto_cover }}" alt="{{ $t->nama_topeng }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[9px] text-[#777]">N/A</div>
                            @endif
                        </button>
                    @empty
                        <span class="text-xs text-[#666] italic">Belum ada topeng.</span>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kanvas 3D Interaktif & Titik Hotspot -->
        <div class="lg:col-span-7 relative h-[500px] sm:h-[600px] flex items-center justify-center">
            
            <!-- Wadah Render 3D / Fallback Image -->
            <div id="modelContainer" class="w-full h-full relative flex items-center justify-center">
                @if($firstTopeng && $firstTopeng->model_3d)
                    <model-viewer 
                        id="viewer3D"
                        src="{{ $firstTopeng->model_3d }}" 
                        camera-controls 
                        auto-rotate 
                        rotation-per-second="12deg"
                        shadow-intensity="1.5" 
                        camera-orbit="0deg 80deg 105%"
                        class="w-full h-full"
                    >
                    </model-viewer>
                @else
                    <div id="imageDisplay" class="relative max-h-full max-w-full flex items-center justify-center">
                        <img 
                            id="activeImage" 
                            src="{{ $firstTopeng?->foto_cover ?? '' }}" 
                            alt="{{ $firstTopeng?->nama_topeng ?? 'Topeng' }}" 
                            class="max-h-[440px] max-w-full object-contain drop-shadow-2xl {{ empty($firstTopeng?->foto_cover) ? 'hidden' : '' }}"
                        >
                        @if(empty($firstTopeng?->foto_cover))
                            <span class="font-serif-celtic text-xs text-[#8A8477] uppercase tracking-widest">Aset Visual Kosong</span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- LAYER OVERLAY HOTSPOT & KOTAK INFORMASI -->
            <div class="absolute inset-0 pointer-events-none z-20">
                
                <!-- Titik 1: Bagian Mahkota / Gelungan (Kanan Atas) -->
                <div class="absolute top-[22%] right-[32%] group pointer-events-auto">
                    <div class="pin-pulse"></div>
                    <!-- Garis Penunjuk ke Kotak Putih -->
                    <div class="hidden group-hover:block absolute bottom-full left-1/2 w-16 h-12 border-t border-l border-white/70 -translate-x-1/2 pointer-events-none"></div>
                    <!-- Kotak Putih Informasi -->
                    <div class="hidden group-hover:block absolute bottom-[calc(100%+45px)] -left-20 info-box-card">
                        <span class="text-[9px] font-bold text-[#8B6B3E] uppercase block mb-1">UKIRAN & ORNAMEN</span>
                        <p id="hotspotUkiran" class="text-xs text-[#2A2A2A] leading-relaxed">
                            {{ $firstTopeng?->nilai_estetika ?: 'Tatah ukiran prada emas kancana dengan ragam hias cengkehan khas Dewa Kocala.' }}
                        </p>
                    </div>
                </div>

                <!-- Titik 2: Bagian Wajah / Hidung (Tengah) -->
                <div class="absolute top-[48%] left-[50%] -translate-x-1/2 -translate-y-1/2 group pointer-events-auto">
                    <div class="pin-pulse"></div>
                    <!-- Kotak Putih Informasi -->
                    <div class="hidden group-hover:block absolute top-[calc(100%+15px)] left-1/2 -translate-x-1/2 info-box-card">
                        <span class="text-[9px] font-bold text-[#8B6B3E] uppercase block mb-1">RAUT KARAKTER & PERAN</span>
                        <p id="hotspotWajah" class="text-xs text-[#2A2A2A] leading-relaxed">
                            {{ $firstTopeng?->deskripsi ?: 'Bentuk ekspresi sakral yang memancarkan wibawa spiritual dalam pementasan.' }}
                        </p>
                    </div>
                </div>

                <!-- Titik 3: Bagian Dagu / Mulut / Bahan (Bawah) -->
                <div class="absolute bottom-[28%] left-[48%] -translate-x-1/2 group pointer-events-auto">
                    <div class="pin-pulse"></div>
                    <!-- Kotak Putih Informasi -->
                    <div class="hidden group-hover:block absolute top-[calc(100%+15px)] -left-24 info-box-card">
                        <span class="text-[9px] font-bold text-[#8B6B3E] uppercase block mb-1">BAHAN DASAR & SAKRALITAS</span>
                        <p id="hotspotBahan" class="text-xs text-[#2A2A2A] leading-relaxed">
                            {{ $firstTopeng?->bahan_pembuatan ?: 'Kayu Pule sakral dengan tahapan ritual pasupati.' }}
                        </p>
                    </div>
                </div>

            </div>

            <!-- Kontrol Aksi Pojok Kanan Atas -->
            <div class="absolute top-4 right-4 flex flex-col space-y-3 z-30 pointer-events-auto">
                <button type="button" onclick="resetRotation()" class="w-9 h-9 rounded-full bg-[#1E1E1E] border border-[#333] hover:border-white text-white flex items-center justify-center text-xs transition-colors" title="Reset Sudut Pandang">
                    &#x21bb;
                </button>
                @if($firstTopeng)
                    <a id="detailLinkTop" href="{{ route('topeng.show', $firstTopeng->id_topeng) }}" class="w-9 h-9 rounded-full bg-[#1E1E1E] border border-[#333] hover:border-white text-white flex items-center justify-center text-xs transition-colors" title="Buka Detail">
                        &nearr;
                    </a>
                @endif
            </div>
        </div>

        <!-- Indikator Geser Desktop -->
        <div class="hidden lg:flex lg:col-span-1 justify-end">
            <span class="text-[9px] font-bold tracking-[0.3em] text-[#555] uppercase [writing-mode:vertical-lr] rotate-180">
                SCROLL FOR GALLERY
            </span>
        </div>
    </div>
</section>

<!-- 2. Galeri Grid Koleksi Abadi -->
<section class="max-w-7xl mx-auto px-6 sm:px-10 py-20">
    <div class="text-center max-w-2xl mx-auto mb-16">
        <div class="w-10 h-0.5 bg-[#8B6B3E] mx-auto mb-4"></div>
        <h2 class="font-serif-celtic text-3xl sm:text-4xl font-bold text-[#5A0E0E]">
            Koleksi Abadi
        </h2>
        <p class="text-xs sm:text-sm text-[#666] mt-4 leading-relaxed">
            Setiap topeng dalam koleksi Dewa Kocala Raqta Talepud bukan sekadar properti panggung, melainkan wadah spiritual yang dihidupkan melalui ritual penyucian.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
        @forelse($topengs as $item)
            <div class="border border-[#EAE6DF] bg-white p-6 flex flex-col justify-between group hover:border-[#D5CFBE] transition-colors">
                <div class="w-full aspect-square bg-[#FAF9F7] flex items-center justify-center overflow-hidden mb-6 p-4">
                    @if($item->foto_cover)
                        <img 
                            src="{{ $item->foto_cover }}" 
                            alt="{{ $item->nama_topeng }}" 
                            class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500"
                        >
                    @else
                        <span class="font-serif-celtic text-xs text-[#A89D88] uppercase tracking-widest">Aset Visual Kosong</span>
                    @endif
                </div>

                <div class="pt-2 border-t border-[#EAE6DF]">
                    <a href="{{ route('topeng.show', $item->id_topeng) }}" class="text-[10px] font-bold tracking-[0.2em] text-[#1E1E1E] hover:text-[#5A0E0E] uppercase inline-flex items-center">
                        LIHAT DETAIL &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-xs text-[#8A8477] italic">
                Belum ada data koleksi topeng tersimpan.
            </div>
        @endforelse
    </div>

    <div class="mt-14 flex justify-center">
        {{ $topengs->links() }}
    </div>
</section>

<!-- Skrip JavaScript Penggantian Topeng Dinamis -->
<script>
    const topengList = @json($semuaTopeng);

    function switchTopeng(index) {
        const item = topengList[index];
        if (!item) return;

        // Perbarui Teks Profil Samping Kiri
        document.getElementById('activeName').innerText = item.nama_topeng || '-';
        document.getElementById('activeFilosofis').innerText = item.makna_filosofis 
            ? `“${item.makna_filosofis}”` 
            : (item.deskripsi ? `“${item.deskripsi}”` : '“Warisan seni pertunjukan sakral yang melambangkan kesucian dan dedikasi spiritual leluhur.”');
        document.getElementById('activeKategori').innerText = item.kategori || '-';
        document.getElementById('activeMaterial').innerText = item.bahan_pembuatan || '-';

        // Perbarui Teks Dalam Kotak Putih Hotspot
        document.getElementById('hotspotUkiran').innerText = item.nilai_estetika || 'Tatah ukiran prada emas kancana dengan motif patra punggel khas Talepud.';
        document.getElementById('hotspotWajah').innerText = item.deskripsi || item.fungsi_pertunjukan || 'Bentuk ekspresi sakral yang memancarkan wibawa spiritual pementasan.';
        document.getElementById('hotspotBahan').innerText = item.bahan_pembuatan || item.nilai_budaya || 'Kayu Pule pilihan dengan lapisan pigmen warna alami tradisi.';

        // Perbarui Tautan Tombol Detail Kanan Atas
        const detailLink = document.getElementById('detailLinkTop');
        if (detailLink) {
            detailLink.href = `/topeng/${item.id_topeng}`;
        }

        // Perbarui Objek 3D / Fallback Image di Kanvas
        const container = document.getElementById('modelContainer');
        if (item.model_3d) {
            container.innerHTML = `
                <model-viewer 
                    id="viewer3D"
                    src="${item.model_3d}" 
                    camera-controls 
                    auto-rotate 
                    rotation-per-second="12deg"
                    shadow-intensity="1.5" 
                    camera-orbit="0deg 80deg 105%"
                    class="w-full h-full">
                </model-viewer>
            `;
        } else {
            const visualUrl = item.foto_cover || '';
            const imgTag = visualUrl 
                ? `<img id="activeImage" src="${visualUrl}" alt="${item.nama_topeng}" class="max-h-[440px] max-w-full object-contain drop-shadow-2xl">`
                : `<span class="font-serif-celtic text-xs text-[#8A8477] uppercase tracking-widest">Aset Visual Kosong</span>`;

            container.innerHTML = `
                <div id="imageDisplay" class="relative max-h-full max-w-full flex items-center justify-center">
                    ${imgTag}
                </div>
            `;
        }
    }

    function resetRotation() {
        const viewer = document.getElementById('viewer3D');
        if (viewer) {
            viewer.cameraOrbit = '0deg 80deg 105%';
            viewer.resetTurntable();
        }
    }
</script>
@endsection