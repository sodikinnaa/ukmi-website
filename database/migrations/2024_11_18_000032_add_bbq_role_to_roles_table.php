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
        // Insert role BBQ jika belum ada
        DB::table('roles')->insertOrIgnore([
            'name' => 'bbq',
            'label' => 'BBQ',
            'description' => 'Badan Badan Khusus UKMI Ar-Rahman',
            'is_system' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus role BBQ (hanya jika tidak digunakan)
        $bbqRole = DB::table('roles')->where('name', 'bbq')->first();
        
        if ($bbqRole) {
            // Cek apakah ada user yang menggunakan role ini
            $usersCount = DB::table('users')->where('role_id', $bbqRole->id)->count();
            
            if ($usersCount === 0) {
                // Hapus permission terkait
                DB::table('permissions')
                    ->where('name', 'like', 'presidium.user.bbq.%')
                    ->orWhere('name', 'like', 'bbq.%')
                    ->delete();
                
                // Hapus role
                DB::table('roles')->where('name', 'bbq')->delete();
            }
        }
    }
};

