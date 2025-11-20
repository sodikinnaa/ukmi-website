# Implementasi Template Tabler untuk UKMI Ar-Rahman

## Struktur Layout

### Base Layout: `layouts.tabler`
Layout utama menggunakan template Tabler dari folder `public/templates/`. Layout ini mencakup:
- Navbar dengan user dropdown
- Sidebar dengan menu dinamis berdasarkan role
- Page header dengan title dan actions
- Alert untuk success/error messages
- Footer

## Struktur Folder Views

### Presidium
```
resources/views/presidium/
├── dashboard/
│   └── index.blade.php           # Dashboard dengan statistik
├── user/
│   └── index.blade.php           # Manajemen User (CRUD)
├── program-kerja/
│   └── index.blade.php           # Manajemen Program Kerja (CRUD)
├── laporan/
│   └── index.blade.php           # Laporan Kegiatan
└── rekap/
    └── index.blade.php           # Rekap Kehadiran (dengan export Excel)
```

### Kabid (Kepala Bidang/Biro)
```
resources/views/kabid/
├── dashboard/
│   └── index.blade.php           # Dashboard Kabid
├── absensi/
│   └── index.blade.php           # Input Absensi
└── dokumentasi/
    └── index.blade.php           # Upload Dokumentasi
```

### Kader
```
resources/views/kader/
├── dashboard/
│   └── index.blade.php           # Dashboard Kader
├── program/
│   └── index.blade.php           # Program yang Dikerjakan
└── absensi/
    └── index.blade.php           # Riwayat Absensi Saya
```

### Pembina
```
resources/views/pembina/
├── dashboard/
│   └── index.blade.php           # Dashboard Pembina
└── laporan/
    └── index.blade.php           # Laporan Kegiatan
```

## Routes Structure

### Presidium Routes (`/presidium/*`)
- `GET /presidium/dashboard` → `presidium.dashboard`
- `GET /presidium/user` → `presidium.user.index`
- `GET /presidium/program-kerja` → `presidium.program-kerja.index`
- `GET /presidium/laporan` → `presidium.laporan.index`
- `GET /presidium/rekap` → `presidium.rekap.index`

### Kabid Routes (`/kabid/*`)
- `GET /kabid/dashboard` → `kabid.dashboard`
- `GET /kabid/absensi` → `kabid.absensi.index`
- `GET /kabid/dokumentasi` → `kabid.dokumentasi.index`

### Kader Routes (`/kader/*`)
- `GET /kader/dashboard` → `kader.dashboard`
- `GET /kader/program` → `kader.program.index`
- `GET /kader/absensi` → `kader.absensi.index`

### Pembina Routes (`/pembina/*`)
- `GET /pembina/dashboard` → `pembina.dashboard`
- `GET /pembina/laporan` → `pembina.laporan.index`

## Menu Sidebar

Menu sidebar otomatis menyesuaikan berdasarkan role user:

### Presidium Menu
- Dashboard
- Manajemen User
- Program Kerja
- Laporan
- Rekap Kehadiran

### Kabid Menu
- Dashboard
- Absensi
- Dokumentasi

### Kader Menu
- Dashboard
- Program Saya
- Absensi Saya

### Pembina Menu
- Dashboard
- Laporan

## Template Tabler Assets

Template Tabler berada di:
```
public/templates/
├── dist/
│   ├── css/
│   │   ├── tabler.min.css
│   │   ├── tabler-flags.min.css
│   │   ├── tabler-payments.min.css
│   │   └── tabler-social.min.css
│   └── js/
│       ├── tabler.min.js
│       └── demo-theme.min.js
└── static/
    ├── logo.svg
    └── avatars/
        └── [avatar images]
```

## Cara Menggunakan Layout Tabler

### 1. Extend Layout
```blade
@extends('layouts.tabler')

@section('title', 'Judul Halaman')
@section('pretitle', 'Subtitle')
```

### 2. Tambahkan Header Actions (Optional)
```blade
@section('header-actions')
    <a href="#" class="btn btn-primary">Tambah Data</a>
@endsection
```

### 3. Tambahkan Content
```blade
@section('content')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <!-- Content here -->
            </div>
        </div>
    </div>
@endsection
```

## Komponen Tabler yang Tersedia

### Cards
```blade
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Judul</h3>
    </div>
    <div class="card-body">
        <!-- Content -->
    </div>
</div>
```

### Tables
```blade
<div class="table-responsive">
    <table class="table table-vcenter card-table">
        <thead>
            <tr>
                <th>Kolom 1</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows -->
        </tbody>
    </table>
</div>
```

### Buttons
```blade
<a href="#" class="btn btn-primary">Primary</a>
<a href="#" class="btn btn-success">Success</a>
<a href="#" class="btn btn-danger">Danger</a>
```

## Fitur Layout

1. **Responsive Design** - Otomatis responsive untuk mobile, tablet, desktop
2. **Dark Mode Support** - Sidebar menggunakan dark theme
3. **Active Menu Highlight** - Menu aktif otomatis ter-highlight
4. **User Dropdown** - Dropdown dengan foto profile dan role
5. **Alert Messages** - Support untuk success dan error messages
6. **Breadcrumb Ready** - Siap untuk ditambahkan breadcrumb jika diperlukan

## Catatan Penting

- Semua view admin menggunakan layout `layouts.tabler`
- Landing page tetap menggunakan layout `layouts.app` (Tailwind CSS)
- Setiap role memiliki folder terpisah untuk memudahkan maintenance
- Menu sidebar otomatis highlight berdasarkan route aktif
- Foto profile menggunakan avatar default jika belum diupload

## Next Steps

1. Implementasi CRUD untuk setiap fitur
2. Tambahkan form untuk input data
3. Implementasi upload file untuk foto
4. Tambahkan export Excel untuk rekap kehadiran
5. Tambahkan pagination untuk tabel data
