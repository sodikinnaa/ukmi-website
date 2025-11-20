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
        Schema::create('pertemuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_kerja_id')->constrained('program_kerja')->onDelete('cascade');
            $table->integer('pertemuan_ke'); // Pertemuan ke berapa (1, 2, 3, dst)
            $table->date('tanggal'); // Tanggal pertemuan
            $table->text('deskripsi')->nullable(); // Deskripsi pertemuan
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Unique constraint: satu program kerja tidak boleh ada pertemuan_ke yang sama
            $table->unique(['program_kerja_id', 'pertemuan_ke']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuan');
    }
};

