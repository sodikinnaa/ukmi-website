# Panduan Autentikasi UKMI Ar-Rahman

## Fitur Login dengan Role-Based Access Control

Sistem autentikasi telah diaktifkan dengan 4 role berbeda:

### 1. Presidium
- **Email**: presidium@ukmi.test
- **Password**: password
- **Akses**: 
  - Mengelola data kader
  - Mengelola data guru (kabid)
  - Mengelola kelas
  - Mengakses laporan

### 2. Kepala Bidang/Biro (Kabid)
- **Email**: kabid@ukmi.test
- **Password**: password
- **Akses**:
  - Mengisi absensi
  - Upload dokumentasi

### 3. Kader
- **Email**: kader@ukmi.test
- **Password**: password
- **Akses**:
  - Melihat program yang dikerjakan

### 4. Pembina/Dewan Pembina
- **Email**: pembina@ukmi.test
- **Password**: password
- **Akses**:
  - Mengakses laporan kegiatan

## Setup Database

1. Jalankan migration:
```bash
php artisan migrate
```

2. Jalankan seeder untuk membuat user contoh:
```bash
php artisan db:seed --class=UserSeeder
```

## Cara Menggunakan

1. Akses halaman login: `http://localhost:8000/login`
2. Login dengan salah satu akun di atas
3. Setelah login, akan diarahkan ke dashboard sesuai role

## Struktur File

- **Controller**: `app/Http/Controllers/Auth/AuthController.php`
- **Middleware**: `app/Http/Middleware/RoleMiddleware.php`
- **Model**: `app/Models/User.php` (sudah ditambahkan method untuk role)
- **Views**: 
  - `resources/views/auth/login.blade.php`
  - `resources/views/dashboard/index.blade.php`
  - `resources/views/dashboard/presidium.blade.php`
  - `resources/views/dashboard/kabid.blade.php`
  - `resources/views/dashboard/kader.blade.php`
  - `resources/views/dashboard/pembina.blade.php`

## Middleware Role

Untuk membatasi akses berdasarkan role, gunakan middleware:

```php
Route::middleware(['auth', 'role:presidium'])->group(function () {
    // Routes hanya untuk Presidium
});
```

## Catatan Keamanan

- Pastikan untuk mengubah password default di production
- Gunakan password yang kuat
- Pertimbangkan untuk menambahkan email verification
