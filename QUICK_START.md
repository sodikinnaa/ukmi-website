# Quick Start Guide - UKMI Ar-Rahman

## 🚀 Setup Awal

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Setup Database
```bash
# Edit .env dengan konfigurasi database Anda
# Kemudian jalankan:
php artisan migrate
php artisan db:seed --class=UserSeeder
```

### 4. Build Assets
```bash
npm run build
# atau untuk development:
npm run dev
```

### 5. Setup Storage
```bash
php artisan storage:link
```

### 6. Jalankan Server
```bash
php artisan serve
```

## 🔐 Login dengan Akun Testing

| Role | Email | Password | URL Dashboard |
|------|-------|----------|---------------|
| **Presidium** | presidium@ukmi.test | password | `/presidium/dashboard` |
| **Kabid** | kabid@ukmi.test | password | `/kabid/dashboard` |
| **Kader** | kader@ukmi.test | password | `/kader/dashboard` |
| **Pembina** | pembina@ukmi.test | password | `/pembina/dashboard` |

## 📂 Struktur Folder Views

```
resources/views/
├── layouts/
│   ├── tabler.blade.php          # Layout admin (Tabler)
│   ├── app.blade.php              # Layout landing (Tailwind)
│   └── partials/
│       ├── navbar.blade.php
│       ├── sidebar.blade.php
│       ├── footer.blade.php
│       └── menu/
│           ├── presidium.blade.php
│           ├── kabid.blade.php
│           ├── kader.blade.php
│           └── pembina.blade.php
│
├── presidium/                     # Views Presidium
│   ├── dashboard/
│   ├── user/
│   ├── program-kerja/
│   ├── laporan/
│   └── rekap/
│
├── kabid/                         # Views Kabid
│   ├── dashboard/
│   ├── absensi/
│   └── dokumentasi/
│
├── kader/                         # Views Kader
│   ├── dashboard/
│   ├── program/
│   └── absensi/
│
└── pembina/                       # Views Pembina
    ├── dashboard/
    └── laporan/
```

## 🎯 Fitur yang Tersedia

### ✅ Sudah Dibuat
- Landing page dengan struktur organisasi
- Login/Logout dengan role-based access
- Dashboard untuk setiap role
- Layout Tabler untuk admin
- Menu sidebar dinamis per role
- Routes terorganisir per role
- Database structure lengkap
- Model dengan relationships

### 📋 Perlu Diimplementasikan
- CRUD Manajemen User
- CRUD Program Kerja
- Form Input Absensi
- Form Upload Dokumentasi
- Export Excel Rekap Kehadiran
- File upload handling

## 🔗 Routes

### Public
- `GET /` → Landing page
- `GET /login` → Login form
- `POST /login` → Process login
- `POST /logout` → Logout

### Presidium (`/presidium/*`)
- `/presidium/dashboard`
- `/presidium/user`
- `/presidium/program-kerja`
- `/presidium/laporan`
- `/presidium/rekap`

### Kabid (`/kabid/*`)
- `/kabid/dashboard`
- `/kabid/absensi`
- `/kabid/dokumentasi`

### Kader (`/kader/*`)
- `/kader/dashboard`
- `/kader/program`
- `/kader/absensi`

### Pembina (`/pembina/*`)
- `/pembina/dashboard`
- `/pembina/laporan`

## 📚 Dokumentasi

- `README_AUTH.md` - Autentikasi
- `README_DATABASE.md` - Database structure
- `README_TABLER.md` - Template Tabler
- `README_STRUCTURE.md` - Struktur folder
- `IMPLEMENTATION_SUMMARY.md` - Ringkasan lengkap

## 🎨 Template

Template Tabler berada di `public/templates/` dan sudah terintegrasi dengan layout admin.

## ⚠️ Catatan

- Semua password default adalah `password` - **ubah di production!**
- Foto profile menggunakan avatar default jika belum diupload
- Semua view admin menggunakan layout `layouts.tabler`
- Landing page menggunakan layout `layouts.app` (Tailwind CSS)
