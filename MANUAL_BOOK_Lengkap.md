# 📘 Manual Book Sistem Manajemen UKMI Ar-Rahman
## Panduan Lengkap Step-by-Step dengan Screenshot

---

## Daftar Isi

1. [Pendahuluan](#pendahuluan)
2. [Akses Sistem](#akses-sistem)
3. [Dashboard](#dashboard)
4. [Panduan Presidium](#panduan-presidium)
   - [Manajemen User](#1-manajemen-user)
   - [Manajemen Periode Kepengurusan](#2-manajemen-periode-kepengurusan)
   - [Manajemen Kategori Biro](#3-manajemen-kategori-biro)
   - [Manajemen Program Kerja](#4-manajemen-program-kerja)
   - [Manajemen Menu](#5-manajemen-menu)
   - [Laporan](#6-laporan)
   - [Rekap](#7-rekap)
   - [Referensi Program Kerja](#8-referensi-program-kerja)
5. [Panduan Kabid](#panduan-kabid)
6. [Panduan Kader](#panduan-kader)
7. [Panduan Pembina](#panduan-pembina)
8. [Fitur Umum](#fitur-umum)
9. [Troubleshooting](#troubleshooting)

---

## Pendahuluan

Sistem Manajemen UKMI Ar-Rahman adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola kegiatan organisasi Unit Kegiatan Mahasiswa Islam (UKMI) Ar-Rahman. Sistem ini menyediakan fitur-fitur untuk mengelola program kerja, absensi, dokumentasi, dan laporan kegiatan.

### Fitur Utama

- ✅ Manajemen User dan Role
- ✅ Manajemen Periode Kepengurusan
- ✅ Manajemen Program Kerja
- ✅ Manajemen Pertemuan
- ✅ Sistem Absensi
- ✅ Dokumentasi Kegiatan
- ✅ Laporan dan Rekap
- ✅ Referensi Program Kerja

### Role dalam Sistem

1. **Presidium** - Administrator dengan akses penuh
2. **Kabid** - Kepala Bidang/Biro
3. **Kader** - Anggota aktif organisasi
4. **Pembina** - Dewan Pembina

---

## Akses Sistem

### 1. Login ke Sistem

#### Langkah 1: Buka Halaman Login

1. Buka browser (Chrome, Firefox, Edge, dll)
2. Ketik URL sistem di address bar:
   - **Development**: `http://127.0.0.1:8009` atau `http://localhost:8009`
   - **Production**: Sesuai URL yang diberikan admin
3. Tekan **Enter**

**Screenshot 1.1:** Halaman landing page dengan tombol Login
```
[INSERT SCREENSHOT: landing-page.png]
Tampilkan halaman landing page dengan logo UKMI dan tombol "Login" di pojok kanan atas
```

#### Langkah 2: Klik Tombol Login

1. Di halaman landing page, klik tombol **"Login"** yang berada di pojok kanan atas
2. Atau langsung akses URL: `http://127.0.0.1:8009/login`

**Screenshot 1.2:** Halaman login
```
[INSERT SCREENSHOT: login-page.png]
Tampilkan halaman login dengan:
- Logo UKMI di bagian atas
- Form login dengan field Email dan Password
- Tombol "Masuk"
- Link "Kembali ke Beranda"
```

#### Langkah 3: Masukkan Kredensial

1. Di field **"Email"**, ketik email Anda (contoh: `usmanpuji@ukmi.test`)
2. Di field **"Password"**, ketik password Anda (default: `password`)
3. **Opsional**: Centang checkbox **"Ingat saya"** jika ingin tetap login
4. Klik tombol **"Masuk"**

**Screenshot 1.3:** Form login yang sudah diisi
```
[INSERT SCREENSHOT: login-filled.png]
Tampilkan form login dengan email dan password yang sudah diisi
```

#### Langkah 4: Verifikasi Login Berhasil

1. Setelah klik "Masuk", sistem akan memproses login
2. Jika berhasil, Anda akan diarahkan ke **Dashboard** sesuai role Anda
3. Jika gagal, akan muncul pesan error (cek email/password)

**Screenshot 1.4:** Dashboard setelah login berhasil
```
[INSERT SCREENSHOT: dashboard-after-login.png]
Tampilkan dashboard sesuai role (Presidium/Kabid/Kader/Pembina)
```

### 2. Kredensial Default (Demo)

**⚠️ PENTING:** Kredensial berikut hanya untuk demo/testing. Pastikan untuk mengubah password di production!

#### Presidium
- **Ketua Umum**: `usmanpuji@ukmi.test` / `password`
- **Wakil Ketua**: `desti@ukmi.test` / `password`
- **Sekretaris**: `ichwan@ukmi.test` / `password`
- **Bendahara**: `dirta@ukmi.test` / `password`

#### Kabid (Contoh)
- **Kaderisasi**: `aldo.kaderisasi@ukmi.test` / `password`
- **KSI**: `soidkin.ksi@ukmi.test` / `password`
- **BBQ**: `bagus.bbq@ukmi.test` / `password`
- **Danus**: `aldo.danus@ukmi.test` / `password`
- **Akademik**: `rangga.akademik@ukmi.test` / `password`
- **HMD**: `rama.hmd@ukmi.test` / `password`

#### Pembina
- **Pembina**: `merli@ukmi.test` / `password`

### 3. Logout dari Sistem

#### Langkah 1: Klik Avatar/Foto Profil

1. Di pojok kanan atas halaman, klik pada **avatar/foto profil** Anda
2. Akan muncul dropdown menu

**Screenshot 3.1:** Dropdown menu user
```
[INSERT SCREENSHOT: user-dropdown.png]
Tampilkan dropdown menu dengan opsi:
- Profile
- Edit Profile
- Logout
```

#### Langkah 2: Pilih Logout

1. Di dropdown menu, klik **"Logout"**
2. Atau klik menu **"Logout"** di bagian bawah sidebar
3. Sistem akan logout dan mengarahkan ke halaman login

**Screenshot 3.2:** Halaman login setelah logout
```
[INSERT SCREENSHOT: after-logout.png]
Tampilkan halaman login setelah logout berhasil
```

---

## Dashboard

Setelah login, setiap role akan diarahkan ke dashboard masing-masing yang menampilkan informasi penting.

### Dashboard Presidium

**Screenshot Dashboard Presidium:**
```
[INSERT SCREENSHOT: dashboard-presidium.png]
Tampilkan dashboard presidium dengan:
- Statistik cards (Program Kerja, Pertemuan, Kader, dll)
- Grafik aktivitas
- Program kerja terbaru
- Menu sidebar
```

### Dashboard Kabid

**Screenshot Dashboard Kabid:**
```
[INSERT SCREENSHOT: dashboard-kabid.png]
Tampilkan dashboard kabid dengan:
- Statistik program kerja di bidangnya
- Pertemuan terbaru
- Menu sidebar
```

### Dashboard Kader

**Screenshot Dashboard Kader:**
```
[INSERT SCREENSHOT: dashboard-kader.png]
Tampilkan dashboard kader dengan:
- Program kerja yang diikuti
- Statistik kehadiran
- Menu sidebar
```

### Dashboard Pembina

**Screenshot Dashboard Pembina:**
```
[INSERT SCREENSHOT: dashboard-pembina.png]
Tampilkan dashboard pembina dengan:
- Statistik kegiatan organisasi
- Grafik aktivitas
- Menu sidebar
```

---

## Panduan Presidium

Presidium memiliki akses penuh untuk mengelola seluruh sistem. Berikut adalah panduan lengkap step-by-step:

### 1. Manajemen User

#### 1.1. Mengakses Halaman Manajemen User

**Langkah 1:** Klik menu **"Manajemen User"** di sidebar

**Screenshot 1.1.1:** Menu sidebar dengan Manajemen User
```
[INSERT SCREENSHOT: sidebar-manajemen-user.png]
Tampilkan sidebar dengan menu "Manajemen User" yang di-highlight
```

**Langkah 2:** Sistem akan menampilkan halaman daftar user

**Screenshot 1.1.2:** Halaman daftar user
```
[INSERT SCREENSHOT: user-index.png]
Tampilkan halaman daftar user dengan:
- Tabel user
- Filter berdasarkan role
- Tombol "Tambah User"
- Tombol "Import User"
```

#### 1.2. Melihat Daftar User

**Langkah 1:** Di halaman Manajemen User, Anda akan melihat tabel dengan kolom:
- Foto Profile
- Nama
- Email
- Role
- Status Aktif
- Periode
- Aksi

**Screenshot 1.2.1:** Tabel daftar user
```
[INSERT SCREENSHOT: user-table.png]
Tampilkan tabel user dengan beberapa data user
```

**Langkah 2:** Gunakan filter untuk mencari user:
- **Filter Role**: Pilih role tertentu (Presidium, Kabid, Kader, Pembina)
- **Filter Status**: Pilih status aktif/tidak aktif
- **Filter Periode**: Pilih periode kepengurusan
- **Search**: Ketik nama atau email untuk mencari

**Screenshot 1.2.2:** Filter user
```
[INSERT SCREENSHOT: user-filter.png]
Tampilkan filter dropdown dan search box
```

#### 1.3. Menambah User Baru

**Langkah 1:** Klik tombol **"Tambah User"** di pojok kanan atas

**Screenshot 1.3.1:** Tombol Tambah User
```
[INSERT SCREENSHOT: button-tambah-user.png]
Tampilkan tombol "Tambah User" yang di-highlight
```

**Langkah 2:** Form tambah user akan muncul

**Screenshot 1.3.2:** Form tambah user (kosong)
```
[INSERT SCREENSHOT: form-tambah-user-kosong.png]
Tampilkan form dengan field:
- Nama Lengkap
- Email
- Password
- Konfirmasi Password
- Role
- NPM
- Jurusan
- Nomor WhatsApp
- Foto Profile
- Status Aktif
```

**Langkah 3:** Isi form dengan data lengkap:

1. **Nama Lengkap** (wajib): Ketik nama lengkap user
2. **Email** (wajib): Ketik email yang valid dan unik
3. **Password** (wajib): Minimal 8 karakter
4. **Konfirmasi Password** (wajib): Ketik ulang password
5. **Role** (wajib): Pilih dari dropdown (Presidium, Kabid, Kader, Pembina)
6. **NPM** (opsional): Ketik NPM jika ada
7. **Jurusan** (opsional): Ketik jurusan
8. **Nomor WhatsApp** (opsional): Format: 081234567890
9. **Foto Profile** (opsional): Klik "Choose File" untuk upload foto
10. **Status Aktif**: Centang jika user aktif

**Screenshot 1.3.3:** Form tambah user yang sudah diisi
```
[INSERT SCREENSHOT: form-tambah-user-filled.png]
Tampilkan form yang sudah diisi dengan data contoh
```

**Langkah 4:** Klik tombol **"Simpan"** di bagian bawah form

**Screenshot 1.3.4:** Tombol Simpan
```
[INSERT SCREENSHOT: button-simpan-user.png]
Tampilkan tombol "Simpan" yang di-highlight
```

**Langkah 5:** Jika berhasil, akan muncul notifikasi sukses dan user baru akan muncul di daftar

**Screenshot 1.3.5:** Notifikasi sukses
```
[INSERT SCREENSHOT: success-notification.png]
Tampilkan alert success "User berhasil ditambahkan"
```

#### 1.4. Mengedit User

**Langkah 1:** Di daftar user, klik tombol **"Edit"** (ikon pensil) pada user yang ingin diubah

**Screenshot 1.4.1:** Tombol Edit user
```
[INSERT SCREENSHOT: button-edit-user.png]
Tampilkan tombol edit yang di-highlight di tabel
```

**Langkah 2:** Form edit akan muncul dengan data user yang sudah terisi

**Screenshot 1.4.2:** Form edit user
```
[INSERT SCREENSHOT: form-edit-user.png]
Tampilkan form edit dengan data user yang sudah terisi
```

**Langkah 3:** Ubah data yang diperlukan, kemudian klik **"Simpan"**

**Screenshot 1.4.3:** Form edit yang sudah diubah
```
[INSERT SCREENSHOT: form-edit-user-changed.png]
Tampilkan form dengan perubahan yang sudah dibuat
```

#### 1.5. Menghapus User

**Langkah 1:** Di daftar user, klik tombol **"Hapus"** (ikon trash) pada user yang ingin dihapus

**Screenshot 1.5.1:** Tombol Hapus user
```
[INSERT SCREENSHOT: button-hapus-user.png]
Tampilkan tombol hapus yang di-highlight
```

**Langkah 2:** Akan muncul dialog konfirmasi

**Screenshot 1.5.2:** Dialog konfirmasi hapus
```
[INSERT SCREENSHOT: confirm-delete-user.png]
Tampilkan modal konfirmasi "Apakah Anda yakin ingin menghapus user ini?"
```

**Langkah 3:** Klik **"Ya, Hapus"** untuk konfirmasi atau **"Batal"** untuk membatalkan

**⚠️ PERHATIAN:** Menghapus user akan menghapus semua data terkait (absensi, dokumentasi, dll)

#### 1.6. Import User dari Excel

**Langkah 1:** Klik tombol **"Import User"** di halaman Manajemen User

**Screenshot 1.6.1:** Tombol Import User
```
[INSERT SCREENSHOT: button-import-user.png]
Tampilkan tombol "Import User" yang di-highlight
```

**Langkah 2:** Halaman import akan muncul. Klik **"Download Template"** untuk mendapatkan template Excel

**Screenshot 1.6.2:** Halaman import user
```
[INSERT SCREENSHOT: import-user-page.png]
Tampilkan halaman import dengan:
- Tombol "Download Template"
- Form upload file Excel
```

**Langkah 3:** Isi template Excel dengan data user

**Screenshot 1.6.3:** Template Excel yang sudah diisi
```
[INSERT SCREENSHOT: excel-template-filled.png]
Tampilkan file Excel dengan data user yang sudah diisi
```

**Langkah 4:** Upload file Excel yang sudah diisi

**Screenshot 1.6.4:** Upload file Excel
```
[INSERT SCREENSHOT: upload-excel.png]
Tampilkan form upload dengan file yang sudah dipilih
```

**Langkah 5:** Klik **"Preview"** untuk melihat data sebelum import

**Screenshot 1.6.5:** Preview data import
```
[INSERT SCREENSHOT: preview-import.png]
Tampilkan preview data user yang akan diimport
```

**Langkah 6:** Klik **"Import"** untuk menyelesaikan import

**Screenshot 1.6.6:** Notifikasi sukses import
```
[INSERT SCREENSHOT: success-import.png]
Tampilkan notifikasi "X user berhasil diimport"
```

### 2. Manajemen Periode Kepengurusan

#### 2.1. Mengakses Halaman Periode Kepengurusan

**Langkah 1:** Klik menu **"Periode Kepengurusan"** di sidebar

**Screenshot 2.1.1:** Menu Periode Kepengurusan
```
[INSERT SCREENSHOT: sidebar-periode.png]
Tampilkan sidebar dengan menu "Periode Kepengurusan"
```

**Langkah 2:** Sistem akan menampilkan daftar periode

**Screenshot 2.1.2:** Daftar periode kepengurusan
```
[INSERT SCREENSHOT: periode-index.png]
Tampilkan daftar periode dengan:
- Nama periode
- Tanggal mulai dan selesai
- Status aktif (badge)
- Tombol "Tambah Periode"
```

#### 2.2. Menambah Periode Baru

**Langkah 1:** Klik tombol **"Tambah Periode"**

**Screenshot 2.2.1:** Tombol Tambah Periode
```
[INSERT SCREENSHOT: button-tambah-periode.png]
Tampilkan tombol "Tambah Periode"
```

**Langkah 2:** Form tambah periode akan muncul

**Screenshot 2.2.2:** Form tambah periode (kosong)
```
[INSERT SCREENSHOT: form-tambah-periode-kosong.png]
Tampilkan form dengan field:
- Nama Periode
- Tanggal Mulai
- Tanggal Selesai
- Status Aktif (checkbox)
```

**Langkah 3:** Isi form:
1. **Nama Periode**: Contoh "Periode 2024-2025"
2. **Tanggal Mulai**: Pilih tanggal mulai periode
3. **Tanggal Selesai**: Pilih tanggal selesai (opsional)
4. **Status Aktif**: Centang jika ini periode aktif

**Screenshot 2.2.3:** Form tambah periode yang sudah diisi
```
[INSERT SCREENSHOT: form-tambah-periode-filled.png]
Tampilkan form yang sudah diisi
```

**Langkah 4:** Klik **"Simpan"**

**⚠️ CATATAN:** Hanya boleh ada satu periode aktif dalam satu waktu. Jika periode baru diaktifkan, periode aktif sebelumnya akan otomatis dinonaktifkan.

#### 2.3. Mengaktifkan Periode

**Langkah 1:** Klik **"Detail"** pada periode yang ingin diaktifkan

**Screenshot 2.3.1:** Tombol Detail periode
```
[INSERT SCREENSHOT: button-detail-periode.png]
Tampilkan tombol "Detail" pada periode
```

**Langkah 2:** Di halaman detail, klik tombol **"Aktifkan Periode"**

**Screenshot 2.3.2:** Halaman detail periode
```
[INSERT SCREENSHOT: periode-detail.png]
Tampilkan halaman detail dengan tombol "Aktifkan Periode"
```

**Langkah 3:** Konfirmasi aktivasi

**Screenshot 2.3.3:** Dialog konfirmasi aktivasi
```
[INSERT SCREENSHOT: confirm-activate-periode.png]
Tampilkan konfirmasi "Apakah Anda yakin ingin mengaktifkan periode ini?"
```

### 3. Manajemen Kategori Biro

#### 3.1. Mengakses Halaman Kategori Biro

**Langkah 1:** Klik menu **"Kategori Biro"** di sidebar

**Screenshot 3.1.1:** Menu Kategori Biro
```
[INSERT SCREENSHOT: sidebar-kategori-biro.png]
Tampilkan sidebar dengan menu "Kategori Biro"
```

**Langkah 2:** Sistem akan menampilkan daftar kategori biro

**Screenshot 3.1.2:** Daftar kategori biro
```
[INSERT SCREENSHOT: kategori-biro-index.png]
Tampilkan daftar kategori biro:
- KSI (Kajian dan Syiar Islam)
- BBQ (Bimbingan Baca Quran)
- HMD (Humas dan Dokumentasi)
- Kaderisasi
- Danus (Dana dan Usaha)
- Akademik
```

#### 3.2. Menambah Kategori Biro

**Langkah 1:** Klik tombol **"Tambah Kategori Biro"**

**Screenshot 3.2.1:** Tombol Tambah Kategori Biro
```
[INSERT SCREENSHOT: button-tambah-kategori.png]
Tampilkan tombol "Tambah Kategori Biro"
```

**Langkah 2:** Form tambah kategori akan muncul

**Screenshot 3.2.2:** Form tambah kategori
```
[INSERT SCREENSHOT: form-tambah-kategori.png]
Tampilkan form dengan field:
- Nama Kategori
- Deskripsi
- Status Aktif
```

**Langkah 3:** Isi form dan klik **"Simpan"**

#### 3.3. Mengelola Kabid per Periode

**Langkah 1:** Klik **"Detail"** pada kategori biro yang ingin dikelola

**Screenshot 3.3.1:** Tombol Detail kategori biro
```
[INSERT SCREENSHOT: button-detail-kategori.png]
Tampilkan tombol "Detail" pada kategori biro
```

**Langkah 2:** Di halaman detail, klik tab **"Kabid"**

**Screenshot 3.3.2:** Tab Kabid di detail kategori
```
[INSERT SCREENSHOT: tab-kabid.png]
Tampilkan tab "Kabid" dengan daftar kabid yang sudah ditambahkan
```

**Langkah 3:** Klik tombol **"Tambah Kabid"**

**Screenshot 3.3.3:** Tombol Tambah Kabid
```
[INSERT SCREENSHOT: button-tambah-kabid.png]
Tampilkan tombol "Tambah Kabid"
```

**Langkah 4:** Modal tambah kabid akan muncul

**Screenshot 3.3.4:** Modal tambah kabid
```
[INSERT SCREENSHOT: modal-tambah-kabid.png]
Tampilkan modal dengan:
- Dropdown "Pilih Periode"
- Dropdown "Pilih Kabid"
- Tombol "Tambah"
```

**Langkah 5:** 
1. Pilih **Periode** dari dropdown (hanya periode yang dimiliki presidium)
2. Pilih **Kabid** dari dropdown (user dengan role Kabid)
3. Klik **"Tambah"**

**Screenshot 3.3.5:** Modal yang sudah diisi
```
[INSERT SCREENSHOT: modal-tambah-kabid-filled.png]
Tampilkan modal dengan periode dan kabid yang sudah dipilih
```

**Langkah 6:** Kabid akan muncul di tabel dengan kolom Periode

**Screenshot 3.3.6:** Daftar kabid dengan periode
```
[INSERT SCREENSHOT: daftar-kabid-periode.png]
Tampilkan tabel kabid dengan kolom:
- Nama
- Email
- Periode
- Aksi (Hapus)
```

**Langkah 7:** Untuk menghapus kabid, klik tombol **"Hapus"** dan konfirmasi

**Screenshot 3.3.7:** Konfirmasi hapus kabid
```
[INSERT SCREENSHOT: confirm-hapus-kabid.png]
Tampilkan dialog konfirmasi hapus kabid
```

### 4. Manajemen Program Kerja

#### 4.1. Mengakses Halaman Program Kerja

**Langkah 1:** Klik menu **"Program Kerja"** di sidebar

**Screenshot 4.1.1:** Menu Program Kerja
```
[INSERT SCREENSHOT: sidebar-program-kerja.png]
Tampilkan sidebar dengan menu "Program Kerja"
```

**Langkah 2:** Sistem akan menampilkan daftar program kerja

**Screenshot 4.1.2:** Daftar program kerja
```
[INSERT SCREENSHOT: program-kerja-index.png]
Tampilkan daftar program kerja dengan:
- Filter (Periode, Status, Kategori Biro)
- Tabel program kerja
- Tombol "Tambah Program Kerja"
```

#### 4.2. Filter Program Kerja

**Langkah 1:** Gunakan filter untuk mencari program kerja:
- **Filter Periode**: Pilih periode tertentu
- **Filter Status**: Pilih status (Draft, Aktif, Selesai, Dibatalkan)
- **Filter Kategori Biro**: Pilih kategori biro

**Screenshot 4.2.1:** Filter program kerja
```
[INSERT SCREENSHOT: filter-program-kerja.png]
Tampilkan filter dropdown yang sudah dipilih
```

**Langkah 2:** Klik tombol **"Filter"** untuk menerapkan filter

**Screenshot 4.2.2:** Hasil filter
```
[INSERT SCREENSHOT: hasil-filter-program-kerja.png]
Tampilkan program kerja yang sudah difilter
```

#### 4.3. Menambah Program Kerja Baru

**Langkah 1:** Klik tombol **"Tambah Program Kerja"**

**Screenshot 4.3.1:** Tombol Tambah Program Kerja
```
[INSERT SCREENSHOT: button-tambah-program-kerja.png]
Tampilkan tombol "Tambah Program Kerja"
```

**Langkah 2:** Form tambah program kerja akan muncul

**Screenshot 4.3.2:** Form tambah program kerja (bagian atas)
```
[INSERT SCREENSHOT: form-tambah-progja-1.png]
Tampilkan bagian atas form:
- Judul Program Kerja
- Deskripsi
- Kategori Biro
- Periode Kepengurusan
```

**Langkah 3:** Isi bagian pertama form:
1. **Judul Program Kerja** (wajib): Contoh "Kajian Rutin Bulanan"
2. **Deskripsi** (wajib): Jelaskan program kerja secara detail
3. **Kategori Biro** (wajib): Pilih dari dropdown (KSI, BBQ, HMD, dll)
4. **Periode Kepengurusan** (wajib): Pilih periode aktif

**Screenshot 4.3.3:** Form bagian pertama yang sudah diisi
```
[INSERT SCREENSHOT: form-tambah-progja-1-filled.png]
Tampilkan form bagian pertama yang sudah diisi
```

**Langkah 4:** Scroll ke bawah untuk bagian kedua form

**Screenshot 4.3.4:** Form tambah program kerja (bagian bawah)
```
[INSERT SCREENSHOT: form-tambah-progja-2.png]
Tampilkan bagian bawah form:
- Foto Program Kerja
- Frekuensi Kegiatan
- Kader yang Mengikuti (checkbox)
```

**Langkah 5:** Isi bagian kedua form:
1. **Foto Program Kerja**: Klik "Choose File" untuk upload pamflet/poster
2. **Frekuensi Kegiatan**: Masukkan jumlah pertemuan yang direncanakan (contoh: 4)
3. **Kader yang Mengikuti**: Centang checkbox kader yang akan mengikuti

**Screenshot 4.3.5:** Form bagian kedua yang sudah diisi
```
[INSERT SCREENSHOT: form-tambah-progja-2-filled.png]
Tampilkan form bagian kedua dengan:
- Foto yang sudah diupload
- Frekuensi kegiatan: 4
- Beberapa kader yang sudah dicentang
```

**Langkah 6:** Klik tombol **"Simpan"** di bagian bawah form

**Screenshot 4.3.6:** Tombol Simpan
```
[INSERT SCREENSHOT: button-simpan-progja.png]
Tampilkan tombol "Simpan" dan "Batal"
```

**Langkah 7:** Jika berhasil, akan muncul notifikasi sukses dan program kerja baru akan muncul di daftar

**Screenshot 4.3.7:** Notifikasi sukses
```
[INSERT SCREENSHOT: success-tambah-progja.png]
Tampilkan alert success "Program kerja berhasil ditambahkan"
```

#### 4.4. Melihat Detail Program Kerja

**Langkah 1:** Di daftar program kerja, klik tombol **"Detail"** pada program kerja yang ingin dilihat

**Screenshot 4.4.1:** Tombol Detail program kerja
```
[INSERT SCREENSHOT: button-detail-progja.png]
Tampilkan tombol "Detail" di tabel program kerja
```

**Langkah 2:** Halaman detail akan menampilkan:
- Informasi program kerja (judul, deskripsi, kategori, periode)
- Foto program kerja
- Daftar peserta
- Daftar pertemuan
- Statistik (jumlah pertemuan, peserta, dll)

**Screenshot 4.4.2:** Halaman detail program kerja (bagian atas)
```
[INSERT SCREENSHOT: progja-detail-1.png]
Tampilkan bagian atas detail:
- Judul dan deskripsi
- Foto program kerja
- Badge status dan kategori
- Statistik cards
```

**Screenshot 4.4.3:** Halaman detail program kerja (bagian peserta)
```
[INSERT SCREENSHOT: progja-detail-2.png]
Tampilkan bagian "Peserta Program Kerja" dengan:
- Daftar peserta
- Tombol "Tambah Peserta"
- Tombol "Hapus" pada setiap peserta
```

**Screenshot 4.4.4:** Halaman detail program kerja (bagian pertemuan)
```
[INSERT SCREENSHOT: progja-detail-3.png]
Tampilkan bagian "Pertemuan" dengan:
- Daftar pertemuan (cards)
- Tombol "Tambah Pertemuan"
- Tombol "Lihat Detail", "Edit", "Hapus" pada setiap pertemuan
```

#### 4.5. Mengelola Peserta Program Kerja

**Langkah 1:** Di halaman detail program kerja, scroll ke bagian **"Peserta Program Kerja"**

**Langkah 2:** Klik tombol **"Tambah Peserta"**

**Screenshot 4.5.1:** Tombol Tambah Peserta
```
[INSERT SCREENSHOT: button-tambah-peserta.png]
Tampilkan tombol "Tambah Peserta"
```

**Langkah 3:** Modal tambah peserta akan muncul

**Screenshot 4.5.2:** Modal tambah peserta
```
[INSERT SCREENSHOT: modal-tambah-peserta.png]
Tampilkan modal dengan:
- Checkbox untuk memilih user (Presidium, Kabid, Kader)
- Informasi user (nama, role, program kerja yang sudah diikuti)
- Tombol "Pilih Semua" dan "Batal Pilih"
- Tombol "Tambah Peserta"
```

**Langkah 4:** 
1. Centang checkbox user yang ingin ditambahkan (bisa pilih beberapa sekaligus)
2. Atau klik **"Pilih Semua"** untuk memilih semua user
3. Klik **"Batal Pilih"** untuk membatalkan semua pilihan

**Screenshot 4.5.3:** Modal dengan user yang sudah dipilih
```
[INSERT SCREENSHOT: modal-tambah-peserta-selected.png]
Tampilkan modal dengan beberapa checkbox yang sudah dicentang
```

**Langkah 5:** Klik tombol **"Tambah Peserta"** (tombol akan menampilkan jumlah user yang dipilih)

**Screenshot 4.5.4:** Tombol dengan jumlah terpilih
```
[INSERT SCREENSHOT: button-tambah-peserta-count.png]
Tampilkan tombol "Tambah 3 Peserta" (contoh)
```

**Langkah 6:** Peserta akan muncul di daftar peserta

**Screenshot 4.5.5:** Daftar peserta setelah ditambahkan
```
[INSERT SCREENSHOT: daftar-peserta-updated.png]
Tampilkan daftar peserta yang sudah diperbarui
```

**Langkah 7:** Untuk menghapus peserta, klik tombol **"Hapus"** (ikon trash) pada peserta yang ingin dihapus

**Screenshot 4.5.6:** Tombol Hapus peserta
```
[INSERT SCREENSHOT: button-hapus-peserta.png]
Tampilkan tombol hapus pada peserta
```

**Langkah 8:** Konfirmasi penghapusan

**Screenshot 4.5.7:** Konfirmasi hapus peserta
```
[INSERT SCREENSHOT: confirm-hapus-peserta.png]
Tampilkan dialog konfirmasi "Apakah Anda yakin ingin menghapus peserta ini?"
```

#### 4.6. Menambah Pertemuan

**Langkah 1:** Di halaman detail program kerja, scroll ke bagian **"Pertemuan"**

**Langkah 2:** Klik tombol **"Tambah Pertemuan"**

**Screenshot 4.6.1:** Tombol Tambah Pertemuan
```
[INSERT SCREENSHOT: button-tambah-pertemuan.png]
Tampilkan tombol "Tambah Pertemuan"
```

**Langkah 3:** Form tambah pertemuan akan muncul

**Screenshot 4.6.2:** Form tambah pertemuan (bagian atas)
```
[INSERT SCREENSHOT: form-tambah-pertemuan-1.png]
Tampilkan bagian atas form:
- Pertemuan Ke (dengan info otomatis)
- Tanggal Pertemuan
- Waktu Mulai
- Waktu Selesai
- Tempat
```

**Langkah 4:** Isi bagian pertama form:
1. **Pertemuan Ke**: Otomatis terisi (contoh: "3"), bisa diubah jika ada gap
2. **Tanggal Pertemuan**: Pilih tanggal dari date picker
3. **Waktu Mulai**: Pilih waktu (contoh: 08:00)
4. **Waktu Selesai**: Pilih waktu (contoh: 10:00)
5. **Tempat**: Ketik tempat pertemuan

**Screenshot 4.6.3:** Form bagian pertama yang sudah diisi
```
[INSERT SCREENSHOT: form-tambah-pertemuan-1-filled.png]
Tampilkan form bagian pertama yang sudah diisi
```

**Langkah 5:** Scroll ke bawah untuk bagian kedua form

**Screenshot 4.6.4:** Form tambah pertemuan (bagian bawah)
```
[INSERT SCREENSHOT: form-tambah-pertemuan-2.png]
Tampilkan bagian bawah form:
- Deskripsi
- Foto Kegiatan (multiple upload)
- Foto Absen (multiple upload)
```

**Langkah 6:** Isi bagian kedua form:
1. **Deskripsi**: Ketik deskripsi pertemuan (opsional)
2. **Foto Kegiatan**: Klik "Choose File" untuk upload foto (bisa upload beberapa)
3. **Foto Absen**: Klik "Choose File" untuk upload foto absen (bisa upload beberapa)

**Screenshot 4.6.5:** Form bagian kedua yang sudah diisi
```
[INSERT SCREENSHOT: form-tambah-pertemuan-2-filled.png]
Tampilkan form bagian kedua dengan:
- Deskripsi yang sudah diisi
- Beberapa foto kegiatan yang sudah diupload
- Beberapa foto absen yang sudah diupload
```

**Langkah 7:** Klik tombol **"Simpan"**

**Screenshot 4.6.6:** Tombol Simpan pertemuan
```
[INSERT SCREENSHOT: button-simpan-pertemuan.png]
Tampilkan tombol "Simpan" dan "Batal"
```

**Langkah 8:** Pertemuan akan muncul di daftar pertemuan

**Screenshot 4.6.7:** Daftar pertemuan setelah ditambahkan
```
[INSERT SCREENSHOT: daftar-pertemuan-updated.png]
Tampilkan card pertemuan baru yang sudah ditambahkan
```

#### 4.7. Melihat Detail Pertemuan

**Langkah 1:** Di daftar pertemuan, klik tombol **"Lihat Detail"** pada pertemuan yang ingin dilihat

**Screenshot 4.7.1:** Tombol Lihat Detail pertemuan
```
[INSERT SCREENSHOT: button-detail-pertemuan.png]
Tampilkan tombol "Lihat Detail" pada card pertemuan
```

**Langkah 2:** Halaman detail pertemuan akan menampilkan:
- Informasi pertemuan (tanggal, waktu, tempat)
- Deskripsi
- Foto kegiatan
- Foto absen
- Tombol Edit dan Hapus

**Screenshot 4.7.2:** Halaman detail pertemuan
```
[INSERT SCREENSHOT: pertemuan-detail.png]
Tampilkan halaman detail pertemuan dengan semua informasi
```

#### 4.8. Mengedit Pertemuan

**Langkah 1:** Di daftar pertemuan, klik tombol **"Edit"** pada pertemuan yang ingin diubah

**Screenshot 4.8.1:** Tombol Edit pertemuan
```
[INSERT SCREENSHOT: button-edit-pertemuan.png]
Tampilkan tombol "Edit" pada card pertemuan
```

**Langkah 2:** Form edit akan muncul dengan data yang sudah terisi

**Screenshot 4.8.2:** Form edit pertemuan
```
[INSERT SCREENSHOT: form-edit-pertemuan.png]
Tampilkan form edit dengan data pertemuan yang sudah terisi
```

**Langkah 3:** Ubah data yang diperlukan, kemudian klik **"Simpan"**

**Screenshot 4.8.3:** Form edit yang sudah diubah
```
[INSERT SCREENSHOT: form-edit-pertemuan-changed.png]
Tampilkan form dengan perubahan yang sudah dibuat
```

#### 4.9. Menghapus Pertemuan

**Langkah 1:** Di daftar pertemuan, klik tombol **"Hapus"** (ikon trash) pada pertemuan yang ingin dihapus

**Screenshot 4.9.1:** Tombol Hapus pertemuan
```
[INSERT SCREENSHOT: button-hapus-pertemuan.png]
Tampilkan tombol hapus (ikon trash) pada card pertemuan
```

**Langkah 2:** Akan muncul dialog konfirmasi

**Screenshot 4.9.2:** Konfirmasi hapus pertemuan
```
[INSERT SCREENSHOT: confirm-hapus-pertemuan.png]
Tampilkan dialog konfirmasi dengan peringatan:
"Menghapus pertemuan akan menghapus semua absensi dan dokumentasi terkait"
```

**Langkah 3:** Klik **"Ya, Hapus"** untuk konfirmasi

**⚠️ PERHATIAN:** 
- Menghapus pertemuan akan menghapus semua absensi dan dokumentasi terkait
- Pertemuan setelahnya akan otomatis di-renumber
- Status program kerja akan otomatis diupdate

**Screenshot 4.9.3:** Daftar pertemuan setelah dihapus
```
[INSERT SCREENSHOT: daftar-pertemuan-after-delete.png]
Tampilkan daftar pertemuan yang sudah diperbarui (pertemuan yang dihapus sudah tidak ada)
```

### 5. Manajemen Menu

#### 5.1. Mengakses Halaman Manajemen Menu

**Langkah 1:** Klik menu **"Manajemen Menu"** di sidebar

**Screenshot 5.1.1:** Menu Manajemen Menu
```
[INSERT SCREENSHOT: sidebar-manajemen-menu.png]
Tampilkan sidebar dengan menu "Manajemen Menu"
```

**Langkah 2:** Sistem akan menampilkan daftar menu dengan hierarki parent-child

**Screenshot 5.1.2:** Daftar menu
```
[INSERT SCREENSHOT: menu-index.png]
Tampilkan daftar menu dengan struktur hierarki:
- Menu Parent
  - Menu Child 1
  - Menu Child 2
```

#### 5.2. Menambah Menu Baru

**Langkah 1:** Klik tombol **"Tambah Menu"**

**Screenshot 5.2.1:** Tombol Tambah Menu
```
[INSERT SCREENSHOT: button-tambah-menu.png]
Tampilkan tombol "Tambah Menu"
```

**Langkah 2:** Form tambah menu akan muncul

**Screenshot 5.2.2:** Form tambah menu
```
[INSERT SCREENSHOT: form-tambah-menu.png]
Tampilkan form dengan field:
- Label
- Icon (SVG code)
- Route
- Parent Menu (dropdown)
- Urutan
- Status Aktif
```

**Langkah 3:** Isi form dan klik **"Simpan"**

### 6. Laporan

#### 6.1. Mengakses Halaman Laporan

**Langkah 1:** Klik menu **"Laporan"** di sidebar

**Screenshot 6.1.1:** Menu Laporan
```
[INSERT SCREENSHOT: sidebar-laporan.png]
Tampilkan sidebar dengan menu "Laporan"
```

**Langkah 2:** Sistem akan menampilkan halaman laporan

**Screenshot 6.1.2:** Halaman laporan
```
[INSERT SCREENSHOT: laporan-index.png]
Tampilkan halaman laporan dengan:
- Filter (Periode, Kategori Biro)
- Tabel laporan
- Tombol "Export Excel"
```

#### 6.2. Filter dan Export Laporan

**Langkah 1:** Pilih filter:
- **Periode**: Pilih periode tertentu
- **Kategori Biro**: Pilih kategori biro

**Screenshot 6.2.1:** Filter laporan
```
[INSERT SCREENSHOT: filter-laporan.png]
Tampilkan filter yang sudah dipilih
```

**Langkah 2:** Klik tombol **"Filter"** untuk menerapkan

**Langkah 3:** Klik tombol **"Export Excel"** untuk mengexport laporan ke Excel

**Screenshot 6.2.2:** Tombol Export Excel
```
[INSERT SCREENSHOT: button-export-excel.png]
Tampilkan tombol "Export Excel"
```

### 7. Rekap

#### 7.1. Mengakses Halaman Rekap

**Langkah 1:** Klik menu **"Rekap"** di sidebar

**Screenshot 7.1.1:** Menu Rekap
```
[INSERT SCREENSHOT: sidebar-rekap.png]
Tampilkan sidebar dengan menu "Rekap"
```

**Langkah 2:** Sistem akan menampilkan halaman rekap

**Screenshot 7.1.2:** Halaman rekap
```
[INSERT SCREENSHOT: rekap-index.png]
Tampilkan halaman rekap dengan:
- Filter (Periode, Program Kerja)
- Tabel rekap kehadiran
- Tombol "Export Excel"
```

#### 7.2. Filter dan Export Rekap

**Langkah 1:** Pilih filter dan klik **"Filter"**

**Langkah 2:** Klik **"Export Excel"** untuk export rekap kehadiran

### 8. Referensi Program Kerja

#### 8.1. Mengakses Halaman Referensi Progja

**Langkah 1:** Klik menu **"Referensi Progja"** di sidebar

**Screenshot 8.1.1:** Menu Referensi Progja
```
[INSERT SCREENSHOT: sidebar-referensi-progja.png]
Tampilkan sidebar dengan menu "Referensi Progja"
```

**Langkah 2:** Sistem akan menampilkan program kerja dari periode sebelumnya (non-aktif)

**Screenshot 8.1.2:** Halaman referensi progja
```
[INSERT SCREENSHOT: referensi-progja-index.png]
Tampilkan halaman dengan:
- Filter (Periode, Status, Kategori Biro, Search)
- Tabel program kerja
- Badge filter aktif (jika ada)
- Tombol "Reset Semua"
```

#### 8.2. Menggunakan Filter (Auto-Filter)

**Langkah 1:** Pilih **Periode** dari dropdown - Filter otomatis terkirim

**Screenshot 8.2.1:** Dropdown Periode
```
[INSERT SCREENSHOT: filter-periode-auto.png]
Tampilkan dropdown Periode yang sudah dipilih, dan halaman otomatis ter-refresh
```

**Langkah 2:** Pilih **Status** dari dropdown - Filter otomatis terkirim

**Screenshot 8.2.2:** Dropdown Status
```
[INSERT SCREENSHOT: filter-status-auto.png]
Tampilkan dropdown Status yang sudah dipilih
```

**Langkah 3:** Pilih **Kategori Biro** dari dropdown - Filter otomatis terkirim

**Screenshot 8.2.3:** Dropdown Kategori Biro
```
[INSERT SCREENSHOT: filter-kategori-auto.png]
Tampilkan dropdown Kategori Biro yang sudah dipilih
```

**Langkah 4:** Ketik di kolom **Search** - Auto-filter setelah 500ms tidak ada input

**Screenshot 8.2.4:** Search box
```
[INSERT SCREENSHOT: search-box.png]
Tampilkan search box dengan teks yang sudah diketik
```

**Langkah 5:** Badge filter aktif akan muncul di bawah filter

**Screenshot 8.2.5:** Badge filter aktif
```
[INSERT SCREENSHOT: badge-filter-aktif.png]
Tampilkan badge filter aktif dengan tombol X untuk menghapus filter individual
```

**Langkah 6:** Klik tombol **"Reset Semua"** untuk menghapus semua filter

**Screenshot 8.2.6:** Tombol Reset Semua
```
[INSERT SCREENSHOT: button-reset-semua.png]
Tampilkan tombol "Reset Semua"
```

#### 8.3. Melihat Detail Program Kerja

**Langkah 1:** Klik tombol **"Detail"** pada program kerja yang ingin dilihat

**Screenshot 8.3.1:** Tombol Detail
```
[INSERT SCREENSHOT: button-detail-referensi.png]
Tampilkan tombol "Detail" di tabel
```

**Langkah 2:** Halaman detail akan menampilkan informasi lengkap program kerja dari periode sebelumnya

**Screenshot 8.3.2:** Detail referensi progja
```
[INSERT SCREENSHOT: referensi-progja-detail.png]
Tampilkan halaman detail program kerja dari periode sebelumnya
```

---

## Panduan Kabid

Kabid (Kepala Bidang/Biro) memiliki akses terbatas untuk mengelola program kerja di bidangnya.

### 1. Dashboard Kabid

**Screenshot Dashboard Kabid:**
```
[INSERT SCREENSHOT: dashboard-kabid-full.png]
Tampilkan dashboard kabid lengkap dengan statistik dan aktivitas
```

### 2. Program Kerja

#### 2.1. Mengakses Halaman Program Kerja

**Langkah 1:** Klik menu **"Program Kerja"** di sidebar

**Screenshot 2.1.1:** Menu Program Kerja (Kabid)
```
[INSERT SCREENSHOT: sidebar-program-kerja-kabid.png]
Tampilkan sidebar kabid dengan menu "Program Kerja"
```

**Langkah 2:** Sistem akan menampilkan program kerja di bidang kabid

**Screenshot 2.1.2:** Daftar program kerja kabid
```
[INSERT SCREENSHOT: program-kerja-kabid-index.png]
Tampilkan daftar program kerja dengan filter:
- Status (default termasuk "Selesai")
- Kategori Biro (otomatis terfilter sesuai bidang kabid)
```

#### 2.2. Mengelola Peserta Program Kerja (Kabid)

**Langkah 1:** Di halaman detail program kerja, klik **"Tambah Peserta"**

**Screenshot 2.2.1:** Tombol Tambah Peserta (Kabid)
```
[INSERT SCREENSHOT: button-tambah-peserta-kabid.png]
Tampilkan tombol "Tambah Peserta" di halaman detail program kerja
```

**Langkah 2:** Modal tambah peserta akan muncul (sama seperti Presidium)

**Langkah 3:** Pilih user dan klik **"Tambah Peserta"**

**⚠️ CATATAN:** Kabid hanya bisa menambah user dalam periode yang sama dengan kabid.

#### 2.3. Mengelola Pertemuan (Kabid)

Kabid memiliki akses penuh untuk mengelola pertemuan di program kerjanya (sama seperti Presidium):

- **Menambah Pertemuan**
- **Melihat Detail Pertemuan**
- **Mengedit Pertemuan**
- **Menghapus Pertemuan**

**Screenshot:** Daftar pertemuan dengan tombol aksi
```
[INSERT SCREENSHOT: pertemuan-kabid-actions.png]
Tampilkan card pertemuan dengan tombol:
- Lihat Detail
- Edit
- Hapus
```

### 3. Absensi

**Status:** Fitur ini sedang dalam pengembangan (Coming Soon)

**Screenshot:** Halaman absensi coming soon
```
[INSERT SCREENSHOT: absensi-coming-soon.png]
Tampilkan halaman absensi dengan pesan "Coming Soon"
```

### 4. Dokumentasi

#### 4.1. Mengakses Halaman Dokumentasi

**Langkah 1:** Klik menu **"Dokumentasi"** di sidebar

**Screenshot 4.1.1:** Menu Dokumentasi
```
[INSERT SCREENSHOT: sidebar-dokumentasi.png]
Tampilkan sidebar dengan menu "Dokumentasi"
```

**Langkah 2:** Sistem akan menampilkan dokumentasi kegiatan di bidang kabid

**Screenshot 4.1.2:** Halaman dokumentasi
```
[INSERT SCREENSHOT: dokumentasi-index.png]
Tampilkan daftar dokumentasi dengan tombol upload
```

### 5. Kader

#### 5.1. Mengakses Halaman Kader

**Langkah 1:** Klik menu **"Kader"** di sidebar

**Screenshot 5.1.1:** Menu Kader (Kabid)
```
[INSERT SCREENSHOT: sidebar-kader-kabid.png]
Tampilkan sidebar dengan menu "Kader"
```

**Langkah 2:** Sistem akan menampilkan daftar kader dalam periode yang sama dengan kabid

**Screenshot 5.1.2:** Daftar kader
```
[INSERT SCREENSHOT: kader-index-kabid.png]
Tampilkan daftar kader dengan informasi lengkap
```

---

## Panduan Kader

Kader memiliki akses terbatas untuk melihat program kerja yang diikutinya.

### 1. Dashboard Kader

**Screenshot Dashboard Kader:**
```
[INSERT SCREENSHOT: dashboard-kader-full.png]
Tampilkan dashboard kader dengan program kerja yang diikuti
```

### 2. Program

#### 2.1. Mengakses Halaman Program

**Langkah 1:** Klik menu **"Program"** di sidebar

**Screenshot 2.1.1:** Menu Program (Kader)
```
[INSERT SCREENSHOT: sidebar-program-kader.png]
Tampilkan sidebar kader dengan menu "Program"
```

**Langkah 2:** Sistem akan menampilkan program kerja yang diikuti oleh kader

**Screenshot 2.1.2:** Daftar program kader
```
[INSERT SCREENSHOT: program-kader-index.png]
Tampilkan daftar program kerja yang diikuti kader
```

#### 2.2. Melihat Detail Program

**Langkah 1:** Klik **"Detail"** pada program kerja

**Screenshot 2.2.1:** Detail program (Kader)
```
[INSERT SCREENSHOT: program-kader-detail.png]
Tampilkan detail program kerja dengan:
- Informasi program
- Daftar peserta
- Daftar pertemuan
- Absensi pribadi kader
- Dokumentasi
```

### 3. Absensi

#### 3.1. Mengakses Halaman Absensi

**Langkah 1:** Klik menu **"Absensi"** di sidebar

**Screenshot 3.1.1:** Menu Absensi (Kader)
```
[INSERT SCREENSHOT: sidebar-absensi-kader.png]
Tampilkan sidebar dengan menu "Absensi"
```

**Langkah 2:** Sistem akan menampilkan riwayat absensi kader

**Screenshot 3.1.2:** Riwayat absensi kader
```
[INSERT SCREENSHOT: absensi-kader-index.png]
Tampilkan riwayat absensi dengan status kehadiran di setiap pertemuan
```

---

## Panduan Pembina

Pembina memiliki akses untuk melihat laporan dan monitoring kegiatan organisasi.

### 1. Dashboard Pembina

**Screenshot Dashboard Pembina:**
```
[INSERT SCREENSHOT: dashboard-pembina-full.png]
Tampilkan dashboard pembina dengan statistik organisasi
```

### 2. Periode Kepengurusan

#### 2.1. Mengakses Halaman Periode

**Langkah 1:** Klik menu **"Periode Kepengurusan"** di sidebar

**Screenshot 2.1.1:** Menu Periode (Pembina)
```
[INSERT SCREENSHOT: sidebar-periode-pembina.png]
Tampilkan sidebar dengan menu "Periode Kepengurusan"
```

**Langkah 2:** Sistem akan menampilkan daftar periode kepengurusan

**Screenshot 2.1.2:** Daftar periode (Pembina)
```
[INSERT SCREENSHOT: periode-index-pembina.png]
Tampilkan daftar periode dengan tombol "Detail"
```

#### 2.2. Melihat Detail Periode dan Struktur Organisasi

**Langkah 1:** Klik **"Detail"** pada periode

**Screenshot 2.2.1:** Detail periode (Pembina)
```
[INSERT SCREENSHOT: periode-detail-pembina.png]
Tampilkan detail periode dengan struktur organisasi
```

### 3. Laporan

#### 3.1. Mengakses Halaman Laporan

**Langkah 1:** Klik menu **"Laporan"** di sidebar

**Screenshot 3.1.1:** Menu Laporan (Pembina)
```
[INSERT SCREENSHOT: sidebar-laporan-pembina.png]
Tampilkan sidebar dengan menu "Laporan"
```

**Langkah 2:** Sistem akan menampilkan laporan kegiatan

**Screenshot 3.1.2:** Halaman laporan (Pembina)
```
[INSERT SCREENSHOT: laporan-index-pembina.png]
Tampilkan laporan dengan filter dan tombol export
```

---

## Fitur Umum

### 1. Profile Management

#### 1.1. Mengakses Profile

**Langkah 1:** Klik **avatar/foto profil** di pojok kanan atas

**Screenshot 1.1.1:** Dropdown user
```
[INSERT SCREENSHOT: user-dropdown-profile.png]
Tampilkan dropdown dengan opsi "Profile" dan "Edit Profile"
```

**Langkah 2:** Pilih **"Profile"** untuk melihat atau **"Edit Profile"** untuk mengedit

**Screenshot 1.1.2:** Halaman profile
```
[INSERT SCREENSHOT: profile-show.png]
Tampilkan halaman profile dengan informasi user
```

#### 1.2. Mengedit Profile

**Langkah 1:** Klik **"Edit Profile"** dari dropdown atau di halaman profile

**Screenshot 1.2.1:** Form edit profile
```
[INSERT SCREENSHOT: profile-edit.png]
Tampilkan form edit profile dengan field:
- Foto profile
- Nama
- Email
- Nomor WhatsApp
- Jurusan
- NPM
- Hobi
- Alamat
```

**Langkah 2:** Ubah data yang diperlukan dan klik **"Simpan"**

**Screenshot 1.2.2:** Form edit yang sudah diubah
```
[INSERT SCREENSHOT: profile-edit-filled.png]
Tampilkan form dengan perubahan yang sudah dibuat
```

### 2. Pencarian dan Filter

**Screenshot:** Contoh penggunaan filter
```
[INSERT SCREENSHOT: filter-example.png]
Tampilkan contoh filter di berbagai halaman
```

### 3. Pagination

**Screenshot:** Pagination
```
[INSERT SCREENSHOT: pagination.png]
Tampilkan pagination dengan tombol Previous, Next, dan nomor halaman
```

### 4. Badge Status

**Screenshot:** Badge status berbagai warna
```
[INSERT SCREENSHOT: badge-status.png]
Tampilkan berbagai badge dengan warna berbeda:
- Biru (Kategori)
- Hijau (Aktif/Sukses)
- Merah (Tidak Aktif/Error)
- Kuning (Peringatan)
- Orange (Khusus)
- Purple (Khusus)
- Secondary (Netral)
```

---

## Troubleshooting

### 1. Tidak Bisa Login

**Masalah:** Email atau password salah

**Solusi:**
- Pastikan email dan password yang dimasukkan benar
- Pastikan tidak ada spasi di awal/akhir email
- Coba reset password melalui admin (Presidium)

**Screenshot:** Error login
```
[INSERT SCREENSHOT: error-login.png]
Tampilkan pesan error "Email atau password salah"
```

### 2. Menu Tidak Muncul

**Masalah:** Menu tertentu tidak muncul di sidebar

**Solusi:**
- Pastikan user memiliki role yang sesuai
- Pastikan menu aktif di Manajemen Menu (untuk Presidium)
- Pastikan user memiliki permission untuk menu tersebut
- Coba refresh halaman (F5)

### 3. Tidak Bisa Menambah Program Kerja

**Masalah:** Tombol "Tambah Program Kerja" tidak muncul atau error saat simpan

**Solusi:**
- Pastikan user adalah Presidium atau Kabid
- Pastikan periode kepengurusan sudah dibuat dan aktif
- Pastikan kategori biro sudah dibuat
- Pastikan semua field wajib sudah diisi
- Cek ukuran file foto (maksimal sesuai setting server)

**Screenshot:** Error validasi
```
[INSERT SCREENSHOT: error-validation.png]
Tampilkan pesan error validasi form
```

### 4. Filter Tidak Berfungsi

**Masalah:** Filter di halaman tidak menghasilkan hasil yang diharapkan

**Solusi:**
- Pastikan filter sudah diisi dengan benar
- Di halaman Referensi Progja, filter otomatis terkirim saat dropdown dipilih (tidak perlu klik tombol)
- Coba clear filter dan isi ulang
- Coba refresh halaman

### 5. Upload File Gagal

**Masalah:** Upload foto atau file gagal

**Solusi:**
- Pastikan ukuran file tidak melebihi batas maksimal (biasanya 2-5 MB)
- Pastikan format file sesuai (JPG, PNG untuk gambar)
- Pastikan folder storage memiliki permission write
- Cek koneksi internet jika upload ke server

**Screenshot:** Error upload
```
[INSERT SCREENSHOT: error-upload.png]
Tampilkan pesan error upload file
```

---

## Catatan Penting

1. **Keamanan:**
   - Jangan bagikan kredensial login
   - Ganti password default di production
   - Logout setelah selesai menggunakan sistem

2. **Backup:**
   - Lakukan backup database secara berkala
   - Backup file upload (foto, dokumentasi) secara berkala

3. **Periode Kepengurusan:**
   - Hanya boleh ada satu periode aktif
   - Pastikan periode baru sudah dibuat sebelum periode lama berakhir

4. **Program Kerja:**
   - Status o