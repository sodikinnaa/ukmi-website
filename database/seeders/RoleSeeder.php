<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'presidium',
                'label' => 'Presidium',
                'description' => 'Ketua Umum, Wakil Ketua Umum, Sekretaris Umum, Sekretaris Ketua Umum, Bendahara Umum',
                'is_system' => true,
            ],
            [
                'name' => 'kabid',
                'label' => 'Kepala Bidang',
                'description' => 'Ketua, Sekretaris, Sekretaris Bidang, Bendahara, Bendahara Bidang',
                'is_system' => true,
            ],
            [
                'name' => 'kader',
                'label' => 'Kader',
                'description' => 'Anggota aktif UKMI Ar-Rahman',
                'is_system' => true,
            ],
            [
                'name' => 'pembina',
                'label' => 'Pembina',
                'description' => 'Pembina UKMI Ar-Rahman',
                'is_system' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}

