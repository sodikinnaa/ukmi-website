<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $presidiumRole = Role::where('name', 'presidium')->first();
        $kabidRole = Role::where('name', 'kabid')->first();
        $kaderRole = Role::where('name', 'kader')->first();
        $pembinaRole = Role::where('name', 'pembina')->first();

        $defaultPassword = Hash::make('password');

        $users = [
            // Presidium
            [
                'name' => 'Usman Puji Rahayu',
                'email' => 'usmanpuji@ukmi.test',
                'role_id' => $presidiumRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Desti Fitriani',
                'email' => 'desti@ukmi.test',
                'role_id' => $presidiumRole?->id,
                'jabatan' => 'Wakil',
            ],
            [
                'name' => 'Ichwan Solihin',
                'email' => 'ichwan@ukmi.test',
                'role_id' => $presidiumRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Dirta Putri Margiati',
                'email' => 'dirta@ukmi.test',
                'role_id' => $presidiumRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // Kaderisasi
            [
                'name' => 'Aldo Fernanda',
                'email' => 'aldo.kaderisasi@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Shafira',
                'email' => 'shafira.kaderisasi@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Siti Nur Inayah',
                'email' => 'siti.kaderisasi@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // KSI
            [
                'name' => 'Soidkin',
                'email' => 'soidkin.ksi@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Renita Verayani',
                'email' => 'renita.ksi@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Fitria Aprianti',
                'email' => 'fitria.ksi@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // BBQ
            [
                'name' => 'Bagus Sifaq Udin',
                'email' => 'bagus.bbq@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Yulistiani',
                'email' => 'yulistiani.bbq@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Novita Ulan Sari',
                'email' => 'novita.bbq@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // Danus
            [
                'name' => 'Aldo Febrian',
                'email' => 'aldo.danus@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Tiara',
                'email' => 'tiara.danus@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Fitri Sutiasih',
                'email' => 'fitri.danus@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // Akademik
            [
                'name' => 'Rangga Setiaji',
                'email' => 'rangga.akademik@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Mufaza',
                'email' => 'mufaza.akademik@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Nova Istiqomah',
                'email' => 'nova.akademik@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // HMD
            [
                'name' => 'Rama Suherman',
                'email' => 'rama.hmd@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Ketua',
            ],
            [
                'name' => 'Sekar Kinasih',
                'email' => 'sekar.hmd@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Sekretaris',
            ],
            [
                'name' => 'Tiara Nada',
                'email' => 'tiara.hmd@ukmi.test',
                'role_id' => $kabidRole?->id,
                'jabatan' => 'Bendahara',
            ],

            // Pembina
            [
                'name' => 'Merli Sanjaya',
                'email' => 'merli@ukmi.test',
                'role_id' => $pembinaRole?->id,
                'jabatan' => null,
            ],
        ];

        $counter = 1;
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $defaultPassword,
                    'role_id' => $userData['role_id'],
                    'jabatan' => $userData['jabatan'] ?? null,
                    'nomor_wa' => '08123' . str_pad((string) $counter, 6, '0', STR_PAD_LEFT),
                    'jurusan' => $userData['role_id'] === $pembinaRole?->id ? 'Pendidikan Agama Islam' : 'Teknik Informatika',
                    'npm' => $userData['role_id'] === $pembinaRole?->id ? null : '2023' . str_pad((string) $counter, 4, '0', STR_PAD_LEFT),
                    'hobi' => 'Berkontribusi untuk UKMI',
                    'alamat' => 'Alamat ' . $userData['name'],
                    'status_aktif' => true,
                ]
            );

            $counter++;
        }
    }
}
