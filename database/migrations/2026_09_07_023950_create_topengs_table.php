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
        Schema::create('topengs', function (Blueprint $table) {
            $table->id('id_topeng');
            
            // Metadata Identitas
            $table->string('nama_topeng', 100);
            $table->enum('kategori', ['Ratu Lingsir', 'Ratu Anom']);
            $table->string('pencipta_pembuat', 100)->nullable();
            $table->string('jenis_koleksi', 100)->default('Tapel Wayang Wong');

            // Model 3D & Aset Visual
            $table->string('model_3d', 255)->nullable(); // URL Supabase
            $table->string('foto_cover', 255)->nullable(); // Thumbnail/Cover jika model belum termuat

            // Metadata Deskripsi & Nilai Budaya
            $table->text('deskripsi')->nullable();
            $table->text('makna_filosofis')->nullable();
            $table->text('fungsi_pertunjukan')->nullable(); // Sakral (Pemuput Karya) / Balih-balihan
            $table->text('nilai_budaya')->nullable();
            $table->text('nilai_estetika')->nullable();

            // Metadata Teknis & Objek
            $table->string('bahan_pembuatan', 100)->nullable(); // Misal: Kayu Pule
            $table->string('periode_sejarah', 100)->nullable(); // Misal: Era 1920-an / 1960-an

            // Metadata Lokasi & Kepemilikan
            $table->string('lokasi_penyimpanan', 150)->default('Pura Bale Bang / Desa Adat Talepud');
            $table->string('pemilik', 100)->default('Desa Adat Talepud');
            $table->string('pengelola', 100)->default('Seka Wayang Wong Dewa Kocala Raqta');

            // Metadata Preservasi / Pelestarian
            $table->string('kondisi_koleksi', 100)->nullable(); // Terawat, Aus, dsb.
            $table->date('tanggal_dokumentasi')->nullable();
            $table->string('petugas_dokumentasi', 100)->nullable();

            // Foreign Key ke tabel users (Admin)
            $table->foreignId('id_admin')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topengs');
    }
};
