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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siswa yang punya progres
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade'); // Materi yang diselesaikan
            $table->enum('status', ['selesai'])->default('selesai');
            $table->timestamps();

            // Membuat pasangan user_id dan materi_id menjadi unik
            // agar seorang siswa tidak bisa menyelesaikan materi yang sama dua kali.
            $table->unique(['user_id', 'materi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};