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
        Schema::create('pemerans', function (Blueprint $table) {
            $table->id('id_pemeran');
            $table->string('nama_pemeran', 100);
            $table->string('foto_pemeran', 255)->nullable();
            $table->text('biodata_singkat')->nullable();
            $table->text('pengalaman')->nullable();
            $table->string('kontak', 50)->nullable();
            
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
        Schema::dropIfExists('pemerans');
    }
};
