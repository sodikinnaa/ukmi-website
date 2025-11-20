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
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto_profile')->nullable()->after('name');
            $table->string('nomor_wa', 20)->nullable()->after('foto_profile');
            $table->string('jurusan')->nullable()->after('nomor_wa');
            $table->string('npm', 20)->nullable()->after('jurusan');
            $table->text('hobi')->nullable()->after('npm');
            $table->text('alamat')->nullable()->after('hobi');
            $table->boolean('status_aktif')->default(true)->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'foto_profile',
                'nomor_wa',
                'jurusan',
                'npm',
                'hobi',
                'alamat',
                'status_aktif',
            ]);
        });
    }
};
