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
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('foto_progja')->nullable();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('kategori_biro', [
                'ksi',      // Kajian dan Syiar Islam
                'bbq',      // Bimbingan Baca Quran
                'hmd',      // Humas dan Dokumentasi
                'kaderisasi',
                'danus'     // Dana dan Usaha
            ]);
            $table->string('frekuensi_kegiatan')->nullable(); // Contoh: "Setiap Senin", "Bulanan", dll
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kerja');
    }
};
