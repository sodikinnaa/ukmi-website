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
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->foreignId('periode_id')->nullable()->after('created_by')->constrained('periode_kepengurusan')->onDelete('set null');
            $table->enum('status', ['draft', 'aktif', 'selesai', 'dibatalkan'])->default('draft')->after('periode_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_kerja', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn(['periode_id', 'status']);
        });
    }
};

