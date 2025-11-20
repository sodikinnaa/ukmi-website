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
        Schema::create('program_kader', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_kerja_id')->constrained('program_kerja')->onDelete('cascade');
            $table->foreignId('kader_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['program_kerja_id', 'kader_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kader');
    }
};
