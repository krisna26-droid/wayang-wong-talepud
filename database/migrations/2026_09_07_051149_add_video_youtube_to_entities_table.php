<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karakters', function (Blueprint $table) {
            $table->string('video_youtube', 255)->nullable();
        });

        Schema::table('pemerans', function (Blueprint $table) {
            $table->string('video_youtube', 255)->nullable();
        });

        Schema::table('arsip_budayas', function (Blueprint $table) {
            $table->string('video_youtube', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('karakters', function (Blueprint $table) {
            $table->dropColumn('video_youtube');
        });

        Schema::table('pemerans', function (Blueprint $table) {
            $table->dropColumn('video_youtube');
        });

        Schema::table('arsip_budayas', function (Blueprint $table) {
            $table->dropColumn('video_youtube');
        });
    }
};