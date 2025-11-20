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
        // Insert default roles jika belum ada
        $defaultRoles = [
            ['name' => 'presidium', 'label' => 'Presidium', 'description' => 'Presidium memiliki akses penuh', 'is_system' => true],
            ['name' => 'kabid', 'label' => 'Kepala Bidang/Biro', 'description' => 'Kepala Bidang/Biro bertanggung jawab untuk absensi dan dokumentasi', 'is_system' => true],
            ['name' => 'kader', 'label' => 'Kader', 'description' => 'Kader dapat melihat program yang dikerjakan', 'is_system' => true],
            ['name' => 'pembina', 'label' => 'Pembina/Dewan Pembina', 'description' => 'Pembina dapat mengakses laporan', 'is_system' => true],
        ];

        foreach ($defaultRoles as $role) {
            DB::table('roles')->insertOrIgnore(array_merge($role, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Simpan role lama ke kolom temporary jika ada
        if (Schema::hasColumn('users', 'role')) {
            // Buat kolom temporary untuk menyimpan role lama
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'role_temp')) {
                    $table->string('role_temp')->nullable()->after('role');
                }
            });

            // Copy data role ke role_temp
            DB::statement('UPDATE users SET role_temp = role WHERE role IS NOT NULL');

            // Hapus kolom role enum
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }

        // Tambah kolom role_id sebagai foreign key
        if (!Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('role_id')->nullable()->after('email')->constrained('roles')->onDelete('restrict');
            });
        }

        // Update existing users dengan role_id berdasarkan role_temp
        $roles = DB::table('roles')->pluck('id', 'name');
        
        if (Schema::hasColumn('users', 'role_temp')) {
            DB::table('users')->whereNotNull('role_temp')->get()->each(function ($user) use ($roles) {
                $roleName = $user->role_temp ?? 'kader';
                $roleId = $roles[$roleName] ?? $roles['kader'];
                
                DB::table('users')->where('id', $user->id)->update(['role_id' => $roleId]);
            });

            // Hapus kolom temporary
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role_temp');
            });
        } else {
            // Jika tidak ada role_temp, set default ke kader
            $kaderRoleId = $roles['kader'] ?? null;
            if ($kaderRoleId) {
                DB::table('users')->whereNull('role_id')->update(['role_id' => $kaderRoleId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['presidium', 'kabid', 'kader', 'pembina'])->default('kader')->after('email');
        });
    }
};

