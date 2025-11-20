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
        Schema::create('periode_kepengurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode'); // Contoh: "Periode 2024-2025"
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('is_aktif')->default(true); // Periode yang sedang aktif
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_kepengurusan');
    }
};

