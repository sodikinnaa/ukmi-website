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
        Schema::create('video_tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('keterangan')->nullable();
            $table->string('modul')->nullable(); // Modul apa (contoh: "Manajemen User", "Program Kerja", dll)
            $table->text('keterangan_modul')->nullable(); // Keterangan detail tentang modul
            $table->string('video_path')->nullable(); // Path ke file video
            $table->string('video_url')->nullable(); // URL video (jika dari external source)
            $table->integer('durasi')->nullable(); // Durasi dalam detik
            $table->integer('urutan')->default(0); // Urutan tampilan
            $table->boolean('is_aktif')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_tutorials');
    }
};

