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
        Schema::create('kader_periode', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kader_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('periode_id')->constrained('periode_kepengurusan')->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint: satu kader bisa di beberapa periode, tapi tidak duplikat di periode yang sama
            $table->unique(['kader_id', 'periode_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kader_periode');
    }
};

