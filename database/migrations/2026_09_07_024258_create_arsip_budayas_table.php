<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsip_budayas', function (Blueprint $table) {
            $table->id('id_arsip');
            
            // Metadata Identitas & Klasifikasi
            $table->string('judul_arsip', 150);
            $table->string('slug', 180)->unique();
            $table->string('kategori', 100); // Pementasan Sakral, Balih-balihan, Sejarah, Upacara Adat
            $table->year('tahun_dokumentasi')->nullable();
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('lokasi_kegiatan', 150)->default('Desa Adat Talepud');
            
            // Berkas Media & Tipe Media
            $table->enum('tipe_media', ['foto', 'video', 'audio', 'dokumen'])->default('foto');
            $table->string('file_media', 255); // URL Supabase Storage
            $table->string('thumbnail', 255)->nullable(); // Gambar cover jika media berupa video
            
            // Konten & Makna Budaya
            $table->text('deskripsi')->nullable();
            $table->text('pesan_budaya')->nullable();
            $table->string('tokoh_terlibat', 255)->nullable(); // Tokoh/karakter yang tampil dalam dokumentasi
            
            // Metadata Kearsipan & Pelestarian
            $table->string('petugas_dokumentasi', 100)->nullable();
            $table->string('sumber_arsip', 100)->default('Puri / Seka Wayang Wong Talepud');
            $table->string('hak_cipta', 100)->default('Desa Adat Talepud');
            
            // Relasi Admin
            $table->foreignId('id_admin')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_budayas');
    }
};
