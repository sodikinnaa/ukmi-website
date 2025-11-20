# Dokumentasi Database UKMI Ar-Rahman

## Struktur Database

### 1. Tabel `users`
Tabel utama untuk menyimpan data user/kader dengan field lengkap:

**Field:**
- `id` - Primary key
- `name` - Nama lengkap
- `email` - Email (unique)
- `password` - Password (hashed)
- `role` - Role user: `presidium`, `kabid`, `kader`, `pembina`
- `foto_profile` - Path foto profile (nullable)
- `nomor_wa` - Nomor WhatsApp (nullable)
- `jurusan` - Jurusan (nullable)
- `npm` - NPM (nullable)
- `hobi` - Hobi (text, nullable)
- `alamat` - Alamat (text, nullable)
- `status_aktif` - Status aktif kader (boolean, default: true)
- `email_verified_at` - Timestamp verifikasi email
- `remember_token` - Token untuk remember me
- `created_at` - Timestamp
- `updated_at` - Timestamp

### 2. Tabel `program_kerja`
Tabel untuk menyimpan data program kerja organisasi.

**Field:**
- `id` - Primary key
- `foto_progja` - Path foto pamflet program kerja (nullable)
- `judul` - Judul program kerja (contoh: "Kajian Islami")
- `deskripsi` - Deskripsi program kerja (text, nullable)
- `kategori_biro` - Kategori biro: `ksi`, `bbq`, `hmd`, `kaderisasi`, `danus`
- `frekuensi_kegiatan` - Frekuensi kegiatan (contoh: "Setiap Senin", "Bulanan")
- `created_by` - Foreign key ke users (user yang membuat)
- `created_at` - Timestamp
- `updated_at` - Timestamp

**Kategori Biro:**
- `ksi` - Kajian dan Syiar Islam
- `bbq` - Bimbingan Baca Quran
- `hmd` - Humas dan Dokumentasi
- `kaderisasi` - Kaderisasi
- `danus` - Dana dan Usaha

### 3. Tabel `absensi`
Tabel untuk menyimpan data absensi kader per program kerja.

**Field:**
- `id` - Primary key
- `program_kerja_id` - Foreign key ke program_kerja
- `kader_id` - Foreign key ke users (kader)
- `tanggal` - Tanggal absensi (date)
- `status` - Status: `hadir`, `izin`, `sakit`, `alpha` (default: alpha)
- `keterangan` - Keterangan (text, nullable)
- `created_by` - Foreign key ke users (user yang input absensi)
- `created_at` - Timestamp
- `updated_at` - Timestamp

**Unique Constraint:** `program_kerja_id`, `kader_id`, `tanggal`

### 4. Tabel `dokumentasi`
Tabel untuk menyimpan foto dokumentasi kegiatan.

**Field:**
- `id` - Primary key
- `program_kerja_id` - Foreign key ke program_kerja
- `foto_dokumentasi` - Path foto dokumentasi
- `deskripsi` - Deskripsi dokumentasi (text, nullable)
- `tanggal_kegiatan` - Tanggal kegiatan (date)
- `uploaded_by` - Foreign key ke users (user yang upload)
- `created_at` - Timestamp
- `updated_at` - Timestamp

### 5. Tabel `program_kader`
Tabel pivot untuk relasi many-to-many antara program kerja dan kader.

**Field:**
- `id` - Primary key
- `program_kerja_id` - Foreign key ke program_kerja
- `kader_id` - Foreign key ke users (kader)
- `created_at` - Timestamp
- `updated_at` - Timestamp

**Unique Constraint:** `program_kerja_id`, `kader_id`

## Relationship

### User Model
- `programKerja()` - Many-to-many: Program kerja yang diikuti kader
- `absensi()` - Has many: Absensi kader
- `dokumentasi()` - Has many: Dokumentasi yang diupload
- `programKerjaDibuat()` - Has many: Program kerja yang dibuat

### ProgramKerja Model
- `creator()` - Belongs to: User yang membuat
- `kader()` - Many-to-many: Kader yang mengikuti
- `absensi()` - Has many: Absensi program kerja
- `dokumentasi()` - Has many: Dokumentasi program kerja

### Absensi Model
- `programKerja()` - Belongs to: Program kerja
- `kader()` - Belongs to: Kader
- `creator()` - Belongs to: User yang input

### Dokumentasi Model
- `programKerja()` - Belongs to: Program kerja
- `uploader()` - Belongs to: User yang upload

## Setup Database

1. Jalankan semua migration:
```bash
php artisan migrate
```

2. Jalankan seeder untuk data contoh:
```bash
php artisan db:seed --class=UserSeeder
```

## Fitur yang Didukung

### Manajemen User
- ✅ Nama lengkap
- ✅ Foto profile
- ✅ Nomor WA
- ✅ Jurusan
- ✅ NPM
- ✅ Hobi
- ✅ Alamat
- ✅ Status aktif kader

### Manajemen Program Kerja
- ✅ Foto Progja (pamflet)
- ✅ Judul
- ✅ Deskripsi
- ✅ Kategori/biro
- ✅ Frekuensi kegiatan

### Absensi & Dokumentasi
- ✅ Upload foto dokumentasi
- ✅ Input absensi per program kerja
- ✅ Status absensi (hadir, izin, sakit, alpha)

### Rekap Kehadiran
- ✅ Data absensi per program kerja
- ✅ Siap untuk export Excel (perlu implementasi controller)

## Catatan

- Semua foto disimpan sebagai path string (perlu implementasi storage)
- Status absensi default adalah `alpha` jika tidak diisi
- Program kerja dapat memiliki banyak kader (many-to-many)
- Setiap absensi unik per program kerja, kader, dan tanggal
