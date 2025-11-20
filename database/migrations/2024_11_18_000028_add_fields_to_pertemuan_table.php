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
        Schema::table('pertemuan', function (Blueprint $table) {
            $table->string('foto_kegiatan')->nullable()->after('deskripsi');
            $table->string('foto_absen')->nullable()->after('foto_kegiatan');
            $table->integer('total_peserta')->nullable()->after('foto_absen');
            $table->string('lokasi_kegiatan')->nullable()->after('total_peserta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pertemuan', function (Blueprint $table) {
            $table->dropColumn(['foto_kegiatan', 'foto_absen', 'total_peserta', 'lokasi_kegiatan']);
        });
    }
};

