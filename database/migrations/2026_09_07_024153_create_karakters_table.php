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
        Schema::create('karakters', function (Blueprint $table) {
            $table->id('id_karakter');
            $table->string('nama_karakter', 100);
            $table->string('peran', 100)->nullable(); // Protagonis, Antagonis, Punakawan/Parekan
            $table->string('visual_karakter', 255)->nullable(); // Foto ilustrasi karakter penuh
            $table->string('audio_karakter', 255)->nullable(); // URL Supabase untuk cuplikan suara/dialog
            $table->text('deskripsi')->nullable();
            $table->text('watak_sifat')->nullable();
            
            // Relasi ke Topeng
            $table->foreignId('id_topeng')->nullable()->constrained('topengs', 'id_topeng')->nullOnDelete();
            
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
        Schema::dropIfExists('karakters');
    }
};
