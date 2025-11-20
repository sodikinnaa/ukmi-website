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
        Schema::create('periode_presidium', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periode_kepengurusan')->onDelete('cascade');
            $table->foreignId('presidium_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint: satu presidium hanya bisa di satu periode dalam waktu yang sama
            $table->unique(['periode_id', 'presidium_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_presidium');
    }
};

