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
        Schema::create('kader_biro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kader_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_biro_id')->constrained('kategori_biro')->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint: satu kader bisa di beberapa biro, tapi tidak duplikat di biro yang sama
            $table->unique(['kader_id', 'kategori_biro_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kader_biro');
    }
};

