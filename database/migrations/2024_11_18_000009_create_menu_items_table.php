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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // nama menu (contoh: 'dashboard', 'user.index', dll)
            $table->string('label'); // label untuk display
            $table->string('route')->nullable(); // route name
            $table->text('icon')->nullable(); // icon SVG atau class (menggunakan text untuk SVG panjang)
            $table->integer('order')->default(0); // urutan menu
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->onDelete('cascade'); // untuk submenu
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};

