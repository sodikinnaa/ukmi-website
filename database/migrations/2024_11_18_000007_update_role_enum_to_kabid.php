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
        // Update enum values untuk mengganti 'instruktur' menjadi 'kabid'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('presidium', 'kabid', 'kader', 'pembina') DEFAULT 'kader'");
        
        // Update data yang sudah ada
        DB::table('users')->where('role', 'instruktur')->update(['role' => 'kabid']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke instruktur
        DB::table('users')->where('role', 'kabid')->update(['role' => 'instruktur']);
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('presidium', 'instruktur', 'kader', 'pembina') DEFAULT 'kader'");
    }
};
