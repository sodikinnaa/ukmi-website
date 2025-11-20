# Struktur Folder dan Layout Sistem UKMI Ar-Rahman

## Struktur Views

### Layout
```
resources/views/
├── layouts/
│   ├── tabler.blade.php          # Base layout menggunakan Tabler template
│   ├── app.blade.php              # Layout untuk landing page (Tailwind)
│   └── partials/
│       ├── navbar.blade.php       # Navbar Tabler
│       ├── sidebar.blade.php      # Sidebar dengan menu dinamis
│       ├── footer.blade.php       # Footer
│       └── menu/
│           ├── presidium.blade.php
│           ├── kabid.blade.php
│           ├── kader.blade.php
│           └── pembina.blade.php
```

### Views per Role

#### Presidium
```
resources/views/presidium/
├── dashboard/
│   └── index.blade.php           # Dashboard Presidium
├── user/
│   └── index.blade.php           # Manajemen User
├── program-kerja/
│   └── index.blade.php           # Manajemen Program Kerja
├── laporan/
│   └── index.blade.php           # Laporan Kegiatan
└── rekap/
    └── index.blade.php           # Rekap Kehadiran (dengan export Excel)
```

#### Kabid (Kepala Bidang/Biro)
```
resources/views/kabid/
├── dashboard/
│   └── index.blade.php           # Dashboard Kabid
├── absensi/
│   └── index.blade.php           # Input Absensi
└── dokumentasi/
    └── index.blade.php           # Upload Dokumentasi
```

#### Kader
```
resources/views/kader/
├── dashboard/
│   └── index.blade.php           # Dashboard Kader
├── program/
│   └── index.blade.php           # Program yang Dikerjakan
└── absensi/
    └── index.blade.php           # Riwayat Absensi Saya
```

#### Pembina
```
resources/views/pembina/
├── dashboard/
│   └── index.blade.php           # Dashboard Pembina
└── laporan/
    └── index.blade.php           # Laporan Kegiatan
```

## Routes Structure

### Presidium Routes
- `/presidium/dashboard` - Dashboard
- `/presidium/user` - Manajemen User
- `/presidium/program-kerja` - Manajemen Program Kerja
- `/presidium/laporan` - Laporan
- `/presidium/rekap` - Rekap Kehadiran

### Kabid Routes
- `/kabid/dashboard` - Dashboard
- `/kabid/absensi` - Input Absensi
- `/kabid/dokumentasi` - Upload Dokumentasi

### Kader Routes
- `/kader/dashboard` - Dashboard
- `/kader/program` - Program Saya
- `/kader/absensi` - Absensi Saya

### Pembina Routes
- `/pembina/dashboard` - Dashboard
- `/pembina/laporan` - Laporan

## Template Tabler

Template Tabler berada di:
```
public/templates/
├── dist/
│   ├── css/          # CSS files
│   ├── js/           # JavaScript files
│   └── libs/         # Library dependencies
└── static/           # Static assets (images, logos, etc)
```

## Layout Features

### Tabler Layout (`layouts.tabler`)
- Navbar dengan user dropdown
- Sidebar dengan menu dinamis berdasarkan role
- Page header dengan title dan actions
- Alert untuk success/error messages
- Footer

### Menu Dinamis
Menu sidebar otomatis menyesuaikan berdasarkan role user:
- **Presidium**: Dashboard, Manajemen User, Program Kerja, Laporan, Rekap Kehadiran
- **Kabid**: Dashboard, Absensi, Dokumentasi
- **Kader**: Dashboard, Program Saya, Absensi Saya
- **Pembina**: Dashboard, Laporan

## Cara Menambah Fitur Baru

1. **Buat view di folder role yang sesuai:**
   ```
   resources/views/{role}/{fitur}/index.blade.php
   ```

2. **Tambahkan route di `routes/web.php`:**
   ```php
   Route::prefix('{role}')->name('{role}.')->middleware(['role:{role}'])->group(function () {
       Route::get('/{fitur}', function () {
           return view('{role}.{fitur}.index', ['user' => Auth::user()]);
       })->name('{fitur}.index');
   });
   ```

3. **Tambahkan menu di `layouts/partials/menu/{role}.blade.php`**

## Catatan

- Semua view admin menggunakan layout `layouts.tabler`
- Landing page tetap menggunakan layout `layouts.app` (Tailwind)
- Setiap role memiliki folder terpisah untuk memudahkan maintenance
- Menu sidebar otomatis highlight berdasarkan route aktif
