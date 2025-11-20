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
        // Drop foreign key constraints terlebih dahulu karena mereka menggunakan index
        // Gunakan query yang lebih sederhana dan kompatibel
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'kategori_biro_kabid' 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        
        foreach ($foreignKeys as $fk) {
            $constraintName = is_object($fk) ? $fk->CONSTRAINT_NAME : (is_array($fk) ? $fk['CONSTRAINT_NAME'] : $fk);
            // Drop foreign key constraint
            DB::statement("ALTER TABLE `kategori_biro_kabid` DROP FOREIGN KEY `{$constraintName}`");
        }
        
        // Drop unique constraint setelah foreign key di-drop
        $indexExists = DB::select("SHOW INDEX FROM `kategori_biro_kabid` WHERE Key_name = 'kategori_biro_kabid_kategori_biro_id_kabid_id_unique'");
        if (!empty($indexExists)) {
            DB::statement('ALTER TABLE `kategori_biro_kabid` DROP INDEX `kategori_biro_kabid_kategori_biro_id_kabid_id_unique`');
        }
        
        // Tambahkan kolom periode_id
        Schema::table('kategori_biro_kabid', function (Blueprint $table) {
            if (!Schema::hasColumn('kategori_biro_kabid', 'periode_id')) {
                $table->foreignId('periode_id')->nullable()->after('kabid_id')->constrained('periode_kepengurusan')->onDelete('cascade');
            }
        });
        
        // Recreate foreign key constraints menggunakan Schema untuk konsistensi
        Schema::table('kategori_biro_kabid', function (Blueprint $table) {
            // Recreate foreign key untuk kategori_biro_id jika belum ada
            $fkExists = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'kategori_biro_kabid' 
                AND COLUMN_NAME = 'kategori_biro_id'
                AND REFERENCED_TABLE_NAME = 'kategori_biro'
            ");
            if (empty($fkExists)) {
                $table->foreign('kategori_biro_id')->references('id')->on('kategori_biro')->onDelete('cascade');
            }
            
            // Recreate foreign key untuk kabid_id jika belum ada
            $fkExists = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'kategori_biro_kabid' 
                AND COLUMN_NAME = 'kabid_id'
                AND REFERENCED_TABLE_NAME = 'users'
            ");
            if (empty($fkExists)) {
                $table->foreign('kabid_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
        
        // Tambahkan unique constraint baru yang mencakup periode_id
        $newIndexExists = DB::select("SHOW INDEX FROM `kategori_biro_kabid` WHERE Key_name = 'kategori_biro_kabid_unique'");
        if (empty($newIndexExists)) {
            DB::statement('ALTER TABLE `kategori_biro_kabid` ADD UNIQUE KEY `kategori_biro_kabid_unique` (`kategori_biro_id`, `kabid_id`, `periode_id`)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key untuk periode_id jika ada
        $fkPeriodeExists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'kategori_biro_kabid' 
            AND COLUMN_NAME = 'periode_id'
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        foreach ($fkPeriodeExists as $fk) {
            $constraintName = is_object($fk) ? $fk->CONSTRAINT_NAME : (is_array($fk) ? $fk['CONSTRAINT_NAME'] : $fk);
            DB::statement("ALTER TABLE `kategori_biro_kabid` DROP FOREIGN KEY `{$constraintName}`");
        }
        
        // Drop unique constraint baru
        $newIndexExists = DB::select("SHOW INDEX FROM `kategori_biro_kabid` WHERE Key_name = 'kategori_biro_kabid_unique'");
        if (!empty($newIndexExists)) {
            DB::statement('ALTER TABLE `kategori_biro_kabid` DROP INDEX `kategori_biro_kabid_unique`');
        }
        
        // Drop kolom periode_id
        Schema::table('kategori_biro_kabid', function (Blueprint $table) {
            if (Schema::hasColumn('kategori_biro_kabid', 'periode_id')) {
                $table->dropColumn('periode_id');
            }
        });
        
        // Kembalikan unique constraint lama
        $oldIndexExists = DB::select("SHOW INDEX FROM `kategori_biro_kabid` WHERE Key_name = 'kategori_biro_kabid_kategori_biro_id_kabid_id_unique'");
        if (empty($oldIndexExists)) {
            DB::statement('ALTER TABLE `kategori_biro_kabid` ADD UNIQUE KEY `kategori_biro_kabid_kategori_biro_id_kabid_id_unique` (`kategori_biro_id`, `kabid_id`)');
        }
    }
};

