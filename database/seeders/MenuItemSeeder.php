<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Presidium Menus
            [
                'name' => 'presidium.dashboard',
                'label' => 'Dashboard',
                'route' => 'presidium.dashboard',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
                'order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.user',
                'label' => 'Manajemen User',
                'route' => 'presidium.user.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>',
                'order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.program-kerja',
                'label' => 'Program Kerja',
                'route' => 'presidium.program-kerja.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.laporan',
                'label' => 'Laporan',
                'route' => 'presidium.laporan.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
                'order' => 4,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.rekap',
                'label' => 'Rekap Kehadiran',
                'route' => 'presidium.rekap.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 5,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.kategori-biro',
                'label' => 'Kategori Biro',
                'route' => 'presidium.kategori-biro.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>',
                'order' => 6,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.periode',
                'label' => 'Periode Kepengurusan',
                'route' => 'presidium.periode.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h.01" /><path d="M12 15h.01" /><path d="M16 15h.01" /></svg>',
                'order' => 7,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.role',
                'label' => 'Pengaturan Role',
                'route' => 'presidium.role.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                'order' => 8,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.referensi-progja',
                'label' => 'Referensi Progja',
                'route' => 'referensi-progja.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
                'order' => 9,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.guide',
                'label' => 'Manual Book / Guide',
                'route' => 'presidium.guide',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.828 4.828a2 2 0 0 0 -.586 1.414v4.172a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4.172a2 2 0 0 0 -.586 -1.414l-4.828 -4.828a2 2 0 0 1 -.586 -1.414v-2.172z" /></svg>',
                'order' => 10,
                'parent_id' => null,
            ],
            [
                'name' => 'presidium.absensi',
                'label' => 'Absensi',
                'route' => 'absensi.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 11,
                'parent_id' => null,
            ],
            
            // Kabid Menus
            [
                'name' => 'kabid.dashboard',
                'label' => 'Dashboard',
                'route' => 'kabid.dashboard',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
                'order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => 'kabid.absensi',
                'label' => 'Absensi',
                'route' => 'absensi.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => 'kabid.dokumentasi',
                'label' => 'Dokumentasi',
                'route' => 'kabid.dokumentasi.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M3.5 15.5l4.5 -4.5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l2.5 2.5" /></svg>',
                'order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => 'kabid.program-kerja',
                'label' => 'Program Kerja',
                'route' => 'kabid.program-kerja.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 4,
                'parent_id' => null,
            ],
            [
                'name' => 'kabid.kader',
                'label' => 'Daftar Kader',
                'route' => 'kabid.kader.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>',
                'order' => 5,
                'parent_id' => null,
            ],
            [
                'name' => 'kabid.referensi-progja',
                'label' => 'Referensi Progja',
                'route' => 'referensi-progja.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
                'order' => 6,
                'parent_id' => null,
            ],
            
            // Kader Menus
            [
                'name' => 'kader.dashboard',
                'label' => 'Dashboard',
                'route' => 'kader.dashboard',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
                'order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => 'kader.program',
                'label' => 'Program Saya',
                'route' => 'kader.program.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => 'kader.absensi',
                'label' => 'Absensi',
                'route' => 'absensi.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => 'kader.referensi-progja',
                'label' => 'Referensi Progja',
                'route' => 'referensi-progja.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
                'order' => 4,
                'parent_id' => null,
            ],
            
            // Pembina Menus
            [
                'name' => 'pembina.dashboard',
                'label' => 'Dashboard',
                'route' => 'pembina.dashboard',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
                'order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => 'pembina.laporan',
                'label' => 'Laporan',
                'route' => 'pembina.laporan.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
                'order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => 'pembina.referensi-progja',
                'label' => 'Referensi Progja',
                'route' => 'referensi-progja.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
                'order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => 'pembina.absensi',
                'label' => 'Absensi',
                'route' => 'absensi.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" /></svg>',
                'order' => 4,
                'parent_id' => null,
            ],
            [
                'name' => 'pembina.periode',
                'label' => 'Pengaturan Periode',
                'route' => 'pembina.periode.index',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h.01" /><path d="M12 15h.01" /><path d="M16 15h.01" /></svg>',
                'order' => 5,
                'parent_id' => null,
            ],
        ];

        foreach ($menus as $menu) {
            $menuItem = MenuItem::updateOrCreate(
                ['name' => $menu['name']],
                array_merge($menu, ['is_active' => true])
            );

            // Buat permission untuk menu ini
            Permission::updateOrCreate(
                ['name' => $menu['name'] . '.access'],
                [
                    'label' => 'Akses ' . $menu['label'],
                    'menu_item_id' => $menuItem->id,
                    'description' => 'Permission untuk mengakses menu ' . $menu['label'],
                ]
            );
        }

        // Tambahkan sub menu untuk Manajemen User berdasarkan role (DINAMIS)
        $userMenuParent = MenuItem::where('name', 'presidium.user')->first();
        if ($userMenuParent) {
            // Get semua role dari database (dinamis)
            $allRoles = \App\Models\Role::orderBy('name')->get();
            
            $subMenus = [];
            $order = 1;
            
            foreach ($allRoles as $role) {
                $subMenus[] = [
                    'name' => 'presidium.user.' . $role->name,
                    'label' => $role->label ?? ucfirst($role->name),
                    'route' => 'presidium.user.index',
                    'icon' => '', // Tidak perlu icon untuk sub menu
                    'order' => $order++,
                    'parent_id' => $userMenuParent->id,
                    'role_id' => $role->id,
                ];
            }

            foreach ($subMenus as $subMenu) {
                $roleId = $subMenu['role_id'];
                unset($subMenu['role_id']);
                
                $subMenuItem = MenuItem::updateOrCreate(
                    ['name' => $subMenu['name']],
                    array_merge($subMenu, ['is_active' => true])
                );

                // Buat permission untuk sub menu
                Permission::updateOrCreate(
                    ['name' => $subMenu['name'] . '.access'],
                    [
                        'label' => 'Akses ' . $subMenu['label'] . ' (Manajemen User)',
                        'menu_item_id' => $subMenuItem->id,
                        'description' => 'Permission untuk mengakses menu ' . $subMenu['label'] . ' di Manajemen User',
                    ]
                );
            }
        }

        // Assign permissions ke default roles
        $presidiumRole = \App\Models\Role::where('name', 'presidium')->first();
        $kabidRole = \App\Models\Role::where('name', 'kabid')->first();
        $kaderRole = \App\Models\Role::where('name', 'kader')->first();
        $pembinaRole = \App\Models\Role::where('name', 'pembina')->first();

        if ($presidiumRole) {
            // Get semua permission untuk presidium (termasuk sub menu user yang dinamis)
            $presidiumPermissionNames = [
                'presidium.dashboard.access',
                'presidium.user.access',
                'presidium.program-kerja.access',
                'presidium.laporan.access',
                'presidium.rekap.access',
                'presidium.kategori-biro.access',
                'presidium.periode.access',
                'presidium.role.access',
                'presidium.referensi-progja.access',
                'presidium.guide.access',
                'presidium.absensi.access',
            ];
            
            // Tambahkan semua permission untuk sub menu user (dinamis)
            $userSubMenuPermissions = Permission::where('name', 'like', 'presidium.user.%.access')->pluck('name')->toArray();
            $presidiumPermissionNames = array_merge($presidiumPermissionNames, $userSubMenuPermissions);
            
            $presidiumPermissions = Permission::whereIn('name', $presidiumPermissionNames)->pluck('id');
            $presidiumRole->permissions()->sync($presidiumPermissions);
        }

        if ($kabidRole) {
            $kabidPermissions = Permission::whereIn('name', [
                'kabid.dashboard.access',
                'kabid.absensi.access',
                'kabid.dokumentasi.access',
                'kabid.program-kerja.access',
                'kabid.kader.access',
                'kabid.referensi-progja.access',
            ])->pluck('id');
            $kabidRole->permissions()->sync($kabidPermissions);
        }

        if ($kaderRole) {
            $kaderPermissions = Permission::whereIn('name', [
                'kader.dashboard.access',
                'kader.program.access',
                'kader.absensi.access',
                'kader.referensi-progja.access',
            ])->pluck('id');
            $kaderRole->permissions()->sync($kaderPermissions);
        }

        if ($pembinaRole) {
            $pembinaPermissions = Permission::whereIn('name', [
                'pembina.dashboard.access',
                'pembina.laporan.access',
                'pembina.referensi-progja.access',
                'pembina.absensi.access',
                'pembina.periode.access',
            ])->pluck('id');
            $pembinaRole->permissions()->sync($pembinaPermissions);
        }
    }
}

