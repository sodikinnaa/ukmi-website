<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriBiro = [
            [
                'kode' => 'ksi',
                'nama' => 'KSI (Kajian dan Syiar Islam)',
                'deskripsi' => 'Biro yang menangani kegiatan kajian dan syiar Islam',
                'is_aktif' => true,
            ],
            [
                'kode' => 'bbq',
                'nama' => 'BBQ (Bimbingan Baca Quran)',
                'deskripsi' => 'Biro yang menangani kegiatan bimbingan baca Quran',
                'is_aktif' => true,
            ],
            [
                'kode' => 'hmd',
                'nama' => 'HMD (Humas dan Dokumentasi)',
                'deskripsi' => 'Biro yang menangani kegiatan humas dan dokumentasi',
                'is_aktif' => true,
            ],
            [
                'kode' => 'kaderisasi',
                'nama' => 'Kaderisasi',
                'deskripsi' => 'Biro yang menangani kegiatan kaderisasi',
                'is_aktif' => true,
            ],
            [
                'kode' => 'danus',
                'nama' => 'Danus (Dana dan Usaha)',
                'deskripsi' => 'Biro yang menangani kegiatan dana dan usaha',
                'is_aktif' => true,
            ],
        ];

        foreach ($kategoriBiro as $biro) {
            DB::table('kategori_biro')->updateOrInsert(
                ['kode' => $biro['kode']],
                $biro
            );
        }
    }
}

