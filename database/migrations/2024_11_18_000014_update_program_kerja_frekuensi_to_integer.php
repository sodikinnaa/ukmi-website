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
        // Set NULL untuk semua data yang bukan integer sebelum mengubah tipe kolom
        // Karena kita tidak bisa langsung convert string ke integer
        \DB::statement('UPDATE program_kerja SET frekuensi_kegiatan = NULL WHERE frekuensi_kegiatan IS NOT NULL AND frekuensi_kegiatan NOT REGEXP "^[0-9]+$"');
        
        Schema::table('program_kerja', function (Blueprint $table) {
            // Ubah kolom frekuensi_kegiatan dari string ke integer
            $table->integer('frekuensi_kegiatan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->string('frekuensi_kegiatan')->nullable()->change();
        });
    }
};

