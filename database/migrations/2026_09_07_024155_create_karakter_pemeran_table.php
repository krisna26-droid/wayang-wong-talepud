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
        Schema::create('karakter_pemeran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karakter')->constrained('karakters', 'id_karakter')->cascadeOnDelete();
            $table->foreignId('id_pemeran')->constrained('pemerans', 'id_pemeran')->cascadeOnDelete();
            $table->string('keterangan', 100)->nullable(); // Misal: Periode pementasan / generasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karakter_pemeran');
    }
};
