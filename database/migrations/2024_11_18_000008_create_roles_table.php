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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // nama role (contoh: 'presidium', 'kabid', dll)
            $table->string('label'); // label untuk display (contoh: 'Presidium', 'Kepala Bidang/Biro')
            $table->text('description')->nullable(); // deskripsi role
            $table->boolean('is_system')->default(false); // apakah role sistem (tidak bisa dihapus)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

