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
        // Handle data yang sudah ada dengan pertemuan_ke null
        // Set pertemuan_ke = 1 untuk data yang tidak memiliki pertemuan_ke
        DB::table('absensi')
            ->whereNull('pertemuan_ke')
            ->update(['pertemuan_ke' => 1]);
        
        // Handle duplicate data: jika ada absensi dengan program_kerja_id, kader_id, pertemuan_ke yang sama
        // Hapus yang lebih lama, simpan yang terbaru
        $duplicates = DB::table('absensi')
            ->select('program_kerja_id', 'kader_id', 'pertemuan_ke', DB::raw('COUNT(*) as count'))
            ->groupBy('program_kerja_id', 'kader_id', 'pertemuan_ke')
            ->having('count', '>', 1)
            ->get();
        
        foreach ($duplicates as $duplicate) {
            // Ambil ID terbaru (terbesar) untuk setiap kombinasi
            $latestId = DB::table('absensi')
                ->where('program_kerja_id', $duplicate->program_kerja_id)
                ->where('kader_id', $duplicate->kader_id)
                ->where('pertemuan_ke', $duplicate->pertemuan_ke)
                ->orderBy('id', 'desc')
                ->value('id');
            
            // Hapus semua kecuali yang terbaru
            if ($latestId) {
                DB::table('absensi')
                    ->where('program_kerja_id', $duplicate->program_kerja_id)
                    ->where('kader_id', $duplicate->kader_id)
                    ->where('pertemuan_ke', $duplicate->pertemuan_ke)
                    ->where('id', '!=', $latestId)
                    ->delete();
            }
        }
        
        // Cari nama index yang sebenarnya untuk unique constraint lama
        $indexes = DB::select("SHOW INDEX FROM `absensi` WHERE Column_name IN ('program_kerja_id', 'kader_id', 'tanggal') AND Non_unique = 0");
        
        $oldIndexName = null;
        if (!empty($indexes)) {
            // Cari index yang memiliki ketiga kolom tersebut
            $indexGroups = [];
            foreach ($indexes as $index) {
                $indexGroups[$index->Key_name][] = $index->Column_name;
            }
            
            foreach ($indexGroups as $keyName => $columns) {
                if (count($columns) === 3 && 
                    in_array('program_kerja_id', $columns) && 
                    in_array('kader_id', $columns) && 
                    in_array('tanggal', $columns)) {
                    $oldIndexName = $keyName;
                    break;
                }
            }
        }
        
        // Drop unique constraint lama menggunakan raw SQL
        // Nonaktifkan foreign key checks sementara untuk menghindari error
        if ($oldIndexName) {
            DB::statement("SET FOREIGN_KEY_CHECKS=0");
            try {
                // Coba drop dengan DROP INDEX langsung
                DB::statement("DROP INDEX `{$oldIndexName}` ON `absensi`");
            } catch (\Exception $e) {
                try {
                    // Jika gagal, coba dengan ALTER TABLE
                    DB::statement("ALTER TABLE `absensi` DROP INDEX `{$oldIndexName}`");
                } catch (\Exception $e2) {
                    // Jika masih gagal, log dan lanjutkan
                    \Log::warning("Failed to drop index {$oldIndexName}: " . $e2->getMessage());
                }
            }
            DB::statement("SET FOREIGN_KEY_CHECKS=1");
        }
        
        Schema::table('absensi', function (Blueprint $table) {
            // Pastikan pertemuan_ke tidak nullable
            $table->integer('pertemuan_ke')->nullable(false)->change();
            
            // Add unique constraint baru: program_kerja_id, kader_id, pertemuan_ke
            // Ini memungkinkan user absen untuk pertemuan berbeda dalam 1 hari yang sama
            $table->unique(['program_kerja_id', 'kader_id', 'pertemuan_ke'], 'absensi_program_kerja_id_kader_id_pertemuan_ke_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop unique constraint baru menggunakan raw SQL
        DB::statement('ALTER TABLE `absensi` DROP INDEX `absensi_program_kerja_id_kader_id_pertemuan_ke_unique`');
        
        Schema::table('absensi', function (Blueprint $table) {
            // Kembalikan pertemuan_ke menjadi nullable
            $table->integer('pertemuan_ke')->nullable()->change();
        });
        
        // Kembalikan unique constraint lama menggunakan raw SQL
        DB::statement('ALTER TABLE `absensi` ADD UNIQUE KEY `absensi_program_kerja_id_kader_id_tanggal_unique` (`program_kerja_id`, `kader_id`, `tanggal`)');
    }
};

