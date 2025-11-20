<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Sebelum mengubah kolom, pastikan tabel kategori_biro sudah ada dan terisi data
        // Kita akan membuat data default dulu
        
        // Tambahkan kolom baru kategori_biro_id
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->foreignId('kategori_biro_id')->nullable()->after('kategori_biro')->constrained('kategori_biro')->onDelete('set null');
        });
        
        // Migrasi data dari enum ke foreign key
        // Mapping kode lama ke kategori_biro baru
        $mapping = [
            'ksi' => 'ksi',
            'bbq' => 'bbq',
            'hmd' => 'hmd',
            'kaderisasi' => 'kaderisasi',
            'danus' => 'danus',
        ];
        
        foreach ($mapping as $kodeLama => $kodeBaru) {
            $kategoriBiro = DB::table('kategori_biro')->where('kode', $kodeBaru)->first();
            if ($kategoriBiro) {
                DB::table('program_kerja')
                    ->where('kategori_biro', $kodeLama)
                    ->update(['kategori_biro_id' => $kategoriBiro->id]);
            }
        }
        
        // Set default untuk yang null (jika ada)
        $defaultBiro = DB::table('kategori_biro')->where('kode', 'ksi')->first();
        if ($defaultBiro) {
            DB::table('program_kerja')
                ->whereNull('kategori_biro_id')
                ->update(['kategori_biro_id' => $defaultBiro->id]);
        }
        
        // Hapus kolom enum lama (opsional, bisa di-comment jika ingin tetap ada untuk backup)
        // Schema::table('program_kerja', function (Blueprint $table) {
        //     $table->dropColumn('kategori_biro');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->dropForeign(['kategori_biro_id']);
            $table->dropColumn('kategori_biro_id');
        });
    }
};

