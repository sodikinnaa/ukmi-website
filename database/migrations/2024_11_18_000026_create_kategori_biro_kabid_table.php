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
        Schema::create('kategori_biro_kabid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_biro_id')->constrained('kategori_biro')->onDelete('cascade');
            $table->foreignId('kabid_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint: satu kabid hanya bisa menjadi kabid di satu kategori biro
            $table->unique(['kategori_biro_id', 'kabid_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_biro_kabid');
    }
};

