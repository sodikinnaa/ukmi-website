# 📘 Manual Book Sistem Manajemen UKMI Ar-Rahman

## Daftar Isi

1. [Pendahuluan](#pendahuluan)
2. [Akses Sistem](#akses-sistem)
3. [Dashboard](#dashboard)
4. [Panduan Presidium](#panduan-presidium)
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

1. Buka browser dan akses URL sistem (contoh: `http://127.0.0.1:8009` atau URL production)
2. Klik tombol **"Login"** atau akses langsung ke halaman login
3. Masukkan **Email** dan **Password** Anda
4. Klik tombol **"Masuk"**

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

### 3. Logout

1. Klik pada **avatar/foto profil** di pojok kanan atas
2. Pilih **"Logout"** atau klik menu **"Logout"** di sidebar
3. Anda akan diarahkan ke halaman login

---

## Dashboard

Setelah login, setiap role akan diarahkan ke dashboard masing-masing yang menampilkan:

- **Statistik kegiatan** (jumlah program kerja, pertemuan, dll)
- **Aktivitas terbaru**
- **Menu navigasi cepat**
- **Notifikasi penting**

---

## Panduan Presidium

Presidium memiliki akses penuh untuk mengelola seluruh sistem. Berikut adalah panduan lengkap:

### 1. Dashboard Presidium

Dashboard menampilkan:
- Statistik program kerja
- Statistik pertemuan
- Statistik kader
- Grafik aktivitas
- Program kerja terbaru

### 2. Manajemen User

**Lokasi:** Menu Sidebar → **Manajemen User**

#### 2.1. Melihat Daftar User

1. Klik menu **"Manajemen User"** di sidebar
2. Sistem akan menampilkan daftar semua user
3. Gunakan filter untuk mencari user berdasarkan:
   - Role (Presidium, Kabid, Kader, Pembina)
   - Status aktif
   - Periode kepengurusan
   - Nama/Email

#### 2.2. Menambah User Baru

1. Di halaman **Manajemen User**, klik tombol **"Tambah User"**
2. Isi form dengan data lengkap:
   - **Nama Lengkap** (wajib)
   - **Email** (wajib, harus unik)
   - **Password** (minimal 8 karakter)
   - **Role** (pilih: Presidium, Kabid, Kader, atau Pembina)
   - **NPM** (opsional)
   - **Jurusan** (opsional)
   - **Nomor WhatsApp** (opsional)
   - **Foto Profile** (opsional)
   - **Status Aktif** (centang jika aktif)
3. Klik **"Simpan"**

#### 2.3. Mengedit User

1. Di daftar user, klik tombol **"Edit"** pada user yang ingin diubah
2. Ubah data yang diperlukan
3. Klik **"Simpan"** untuk menyimpan perubahan

#### 2.4. Menghapus User

1. Di daftar user, klik tombol **"Hapus"** pada user yang ingin dihapus
2. Konfirmasi penghapusan
3. **⚠️ PERHATIAN:** Penghapusan user akan menghapus semua data terkait

#### 2.5. Import User (Excel)

1. Klik tombol **"Import User"**
2. Download template Excel terlebih dahulu
3. Isi template dengan data user
4. Upload file Excel yang sudah diisi
5. Preview data sebelum import
6. Klik **"Import"** untuk menyelesaikan

### 3. Manajemen Periode Kepengurusan

**Lokasi:** Menu Sidebar → **Periode Kepengurusan**

#### 3.1. Melihat Daftar Periode

1. Klik menu **"Periode Kepengurusan"**
2. Sistem menampilkan daftar semua periode
3. Periode aktif ditandai dengan badge **"Aktif"**

#### 3.2. Menambah Periode Baru

1. Klik tombol **"Tambah Periode"**
2. Isi form:
   - **Nama Periode** (contoh: "Periode 2024-2025")
   - **Tanggal Mulai** (wajib)
   - **Tanggal Selesai** (opsional)
   - **Status Aktif** (centang jika ini periode aktif)
3. Klik **"Simpan"**

**⚠️ CATATAN:** Hanya boleh ada satu periode aktif dalam satu waktu.

#### 3.3. Mengaktifkan Periode

1. Di daftar periode, klik **"Detail"** pada periode yang ingin diaktifkan
2. Klik tombol **"Aktifkan Periode"**
3. Sistem akan otomatis menonaktifkan periode aktif sebelumnya

### 4. Manajemen Kategori Biro

**Lokasi:** Menu Sidebar → **Kategori Biro**

#### 4.1. Melihat Daftar Kategori Biro

Kategori biro yang tersedia:
- **KSI** - Kajian dan Syiar Islam
- **BBQ** - Bimbingan Baca Quran
- **HMD** - Humas dan Dokumentasi
- **Kaderisasi**
- **Danus** - Dana dan Usaha
- **Akademik**

#### 4.2. Menambah Kategori Biro

1. Klik tombol **"Tambah Kategori Biro"**
2. Isi form:
   - **Nama Kategori** (wajib)
   - **Deskripsi** (opsional)
   - **Status Aktif** (centang jika aktif)
3. Klik **"Simpan"**

#### 4.3. Mengelola Kabid per Periode

1. Klik **"Detail"** pada kategori biro yang ingin dikelola
2. Di tab **"Kabid"**, Anda dapat:
   - **Menambah Kabid**: Pilih periode dan user yang akan menjadi kabid
   - **Menghapus Kabid**: Klik tombol hapus pada kabid yang ingin dihapus

**⚠️ PENTING:** Setiap kabid harus dikaitkan dengan periode kepengurusan tertentu.

### 5. Manajemen Program Kerja

**Lokasi:** Menu Sidebar → **Program Kerja**

#### 5.1. Melihat Daftar Program Kerja

1. Klik menu **"Program Kerja"**
2. Gunakan filter untuk mencari program kerja:
   - **Periode** (pilih periode tertentu)
   - **Status** (Draft, Aktif, Selesai, Dibatalkan)
   - **Kategori Biro** (KSI, BBQ, HMD, dll)

#### 5.2. Menambah Program Kerja Baru

1. Klik tombol **"Tambah Program Kerja"**
2. Isi form dengan lengkap:
   - **Judul Program Kerja** (wajib)
   - **Deskripsi** (wajib)
   - **Kategori Biro** (pilih dari dropdown)
   - **Periode Kepengurusan** (pilih periode)
   - **Foto Program Kerja** (upload pamflet/poster)
   - **Frekuensi Kegiatan** (jumlah pertemuan yang direncanakan)
   - **Kader yang Mengikuti** (pilih kader dengan checkbox)
3. Klik **"Simpan"**

#### 5.3. Mengelola Peserta Program Kerja

1. Di halaman detail program kerja, scroll ke bagian **"Peserta Program Kerja"**
2. **Menambah Peserta:**
   - Klik tombol **"Tambah Peserta"**
   - Pilih user dengan checkbox (bisa pilih semua role dalam periode yang sama)
   - Klik **"Tambah Peserta"**
3. **Menghapus Peserta:**
   - Klik tombol **"Hapus"** pada peserta yang ingin dihapus
   - Konfirmasi penghapusan

#### 5.4. Mengelola Pertemuan

1. Di halaman detail program kerja, scroll ke bagian **"Pertemuan"**
2. **Menambah Pertemuan:**
   - Klik tombol **"Tambah Pertemuan"**
   - Isi form:
     - **Pertemuan Ke** (otomatis diisi, bisa diubah jika ada gap)
     - **Tanggal Pertemuan** (wajib)
     - **Waktu Mulai** (wajib)
     - **Waktu Selesai** (wajib)
     - **Tempat** (wajib)
     - **Deskripsi** (opsional)
     - **Foto Kegiatan** (opsional, bisa upload beberapa)
     - **Foto Absen** (opsional, bisa upload beberapa)
   - Klik **"Simpan"**

3. **Melihat Detail Pertemuan:**
   - Klik tombol **"Lihat Detail"** pada kartu pertemuan
   - Halaman detail menampilkan semua informasi pertemuan

4. **Mengedit Pertemuan:**
   - Klik tombol **"Edit"** pada kartu pertemuan
   - Ubah data yang diperlukan
   - Klik **"Simpan"**

5. **Menghapus Pertemuan:**
   - Klik tombol **"Hapus"** (ikon trash) pada kartu pertemuan
   - Konfirmasi penghapusan
   - **⚠️ PERHATIAN:** Menghapus pertemuan akan menghapus semua absensi dan dokumentasi terkait

#### 5.5. Status Program Kerja

Program kerja memiliki status:
- **Draft** - Masih dalam perencanaan
- **Aktif** - Sedang berjalan
- **Selesai** - Sudah selesai (otomatis ketika semua pertemuan selesai)
- **Dibatalkan** - Dibatalkan

**Status otomatis berubah menjadi "Selesai"** ketika jumlah pertemuan mencapai frekuensi kegiatan yang direncanakan.

### 6. Manajemen Menu

**Lokasi:** Menu Sidebar → **Manajemen Menu**

Menu sidebar dapat dikustomisasi melalui fitur ini.

#### 6.1. Melihat Daftar Menu

1. Klik menu **"Manajemen Menu"**
2. Sistem menampilkan struktur menu dengan hierarki parent-child

#### 6.2. Menambah Menu Baru

1. Klik tombol **"Tambah Menu"**
2. Isi form:
   - **Label** (nama menu yang ditampilkan)
   - **Icon** (SVG code untuk icon)
   - **Route** (nama route Laravel)
   - **Parent Menu** (pilih jika ini submenu)
   - **Urutan** (order untuk sorting)
   - **Status Aktif** (centang jika aktif)
3. Klik **"Simpan"**

### 7. Laporan

**Lokasi:** Menu Sidebar → **Laporan**

1. Klik menu **"Laporan"**
2. Pilih periode dan kategori biro untuk filter
3. Sistem menampilkan laporan kegiatan
4. Dapat export ke Excel dengan klik tombol **"Export Excel"**

### 8. Rekap

**Lokasi:** Menu Sidebar → **Rekap**

1. Klik menu **"Rekap"**
2. Pilih periode dan program kerja
3. Sistem menampilkan rekap kehadiran kader
4. Dapat export ke Excel

### 9. Referensi Program Kerja

**Lokasi:** Menu Sidebar → **Referensi Progja**

1. Klik menu **"Referensi Progja"**
2. Sistem menampilkan program kerja dari periode sebelumnya (non-aktif)
3. Gunakan filter untuk mencari:
   - **Periode** (dropdown - auto filter saat dipilih)
   - **Status** (dropdown - auto filter saat dipilih)
   - **Kategori Biro** (dropdown - auto filter saat dipilih)
   - **Pencarian** (ketik untuk mencari judul/deskripsi)
4. Klik **"Detail"** untuk melihat detail program kerja

**⚠️ CATATAN:** Filter otomatis terkirim saat dropdown dipilih, tidak perlu klik tombol filter.

---

## Panduan Kabid

Kabid (Kepala Bidang/Biro) memiliki akses terbatas untuk mengelola program kerja di bidangnya.

### 1. Dashboard Kabid

Dashboard menampilkan:
- Program kerja di bidangnya
- Statistik pertemuan
- Aktivitas terbaru

### 2. Program Kerja

**Lokasi:** Menu Sidebar → **Program Kerja**

#### 2.1. Melihat Daftar Program Kerja

1. Klik menu **"Program Kerja"**
2. Sistem menampilkan program kerja di bidang kabid
3. **Kabid dapat melihat program kerja dengan status "Selesai"** (default ditampilkan)
4. Gunakan filter untuk mencari:
   - **Status** (Aktif, Selesai, Dibatalkan)
   - **Kategori Biro** (otomatis terfilter sesuai bidang kabid)

#### 2.2. Melihat Detail Program Kerja

1. Klik **"Detail"** pada program kerja yang ingin dilihat
2. Halaman detail menampilkan:
   - Informasi program kerja
   - Daftar peserta
   - Daftar pertemuan
   - Absensi
   - Dokumentasi

#### 2.3. Mengelola Peserta Program Kerja

Kabid dapat menambah dan menghapus peserta program kerja dengan ketentuan:
- Hanya user dalam periode yang sama dengan kabid
- Bisa memilih semua role (Presidium, Kabid, Kader)

**Cara menambah peserta:**
1. Di halaman detail program kerja, klik **"Tambah Peserta"**
2. Pilih user dengan checkbox (bisa pilih beberapa sekaligus)
3. Klik **"Tambah Peserta"**

**Cara menghapus peserta:**
1. Klik tombol **"Hapus"** pada peserta yang ingin dihapus
2. Konfirmasi penghapusan

#### 2.4. Mengelola Pertemuan

Kabid memiliki akses penuh untuk mengelola pertemuan di program kerjanya:

**Menambah Pertemuan:**
1. Di halaman detail program kerja, klik **"Tambah Pertemuan"**
2. Isi form dengan lengkap
3. Klik **"Simpan"**

**Melihat Detail Pertemuan:**
1. Klik **"Lihat Detail"** pada kartu pertemuan
2. Halaman detail menampilkan semua informasi pertemuan

**Mengedit Pertemuan:**
1. Klik **"Edit"** pada kartu pertemuan
2. Ubah data yang diperlukan
3. Klik **"Simpan"**

**Menghapus Pertemuan:**
1. Klik tombol **"Hapus"** (ikon trash) pada kartu pertemuan
2. Konfirmasi penghapusan
3. **⚠️ PERHATIAN:** Menghapus pertemuan akan menghapus semua absensi dan dokumentasi terkait

### 3. Absensi

**Lokasi:** Menu Sidebar → **Absensi**

**Status:** Fitur ini sedang dalam pengembangan (Coming Soon)

### 4. Dokumentasi

**Lokasi:** Menu Sidebar → **Dokumentasi**

1. Klik menu **"Dokumentasi"**
2. Sistem menampilkan dokumentasi kegiatan di bidang kabid
3. Dapat upload dokumentasi baru
4. Dapat melihat dan mengedit dokumentasi yang sudah ada

### 5. Kader

**Lokasi:** Menu Sidebar → **Kader**

1. Klik menu **"Kader"**
2. Sistem menampilkan daftar kader dalam periode yang sama dengan kabid
3. Dapat melihat detail kader

---

## Panduan Kader

Kader memiliki akses terbatas untuk melihat program kerja yang diikutinya.

### 1. Dashboard Kader

Dashboard menampilkan:
- Program kerja yang diikuti
- Statistik kehadiran
- Aktivitas terbaru

### 2. Program

**Lokasi:** Menu Sidebar → **Program**

1. Klik menu **"Program"**
2. Sistem menampilkan program kerja yang diikuti oleh kader
3. Klik **"Detail"** untuk melihat detail program kerja
4. Di halaman detail, kader dapat melihat:
   - Informasi program kerja
   - Daftar peserta
   - Daftar pertemuan
   - Absensi pribadi
   - Dokumentasi

### 3. Absensi

**Lokasi:** Menu Sidebar → **Absensi**

1. Klik menu **"Absensi"**
2. Sistem menampilkan riwayat absensi kader
3. Dapat melihat status kehadiran di setiap pertemuan

---

## Panduan Pembina

Pembina memiliki akses untuk melihat laporan dan monitoring kegiatan organisasi.

### 1. Dashboard Pembina

Dashboard menampilkan:
- Statistik kegiatan organisasi
- Grafik aktivitas
- Program kerja aktif

### 2. Periode Kepengurusan

**Lokasi:** Menu Sidebar → **Periode Kepengurusan**

1. Klik menu **"Periode Kepengurusan"**
2. Sistem menampilkan daftar periode kepengurusan
3. Dapat melihat detail periode
4. Dapat melihat struktur organisasi per periode

### 3. Laporan

**Lokasi:** Menu Sidebar → **Laporan**

1. Klik menu **"Laporan"**
2. Pilih periode dan kategori biro untuk filter
3. Sistem menampilkan laporan kegiatan
4. Dapat export ke Excel

---

## Fitur Umum

### 1. Profile

Semua user dapat mengakses dan mengedit profile mereka:

1. Klik **avatar/foto profil** di pojok kanan atas
2. Pilih **"Profile"** atau **"Edit Profile"**
3. Ubah data yang diperlukan:
   - Foto profile
   - Nama
   - Email
   - Nomor WhatsApp
   - Jurusan
   - NPM
   - Hobi
   - Alamat
4. Klik **"Simpan"**

### 2. Pencarian dan Filter

Kebanyakan halaman memiliki fitur pencarian dan filter:
- **Pencarian**: Ketik di kolom search untuk mencari data
- **Filter**: Gunakan dropdown filter untuk mempersempit hasil
- **Auto-filter**: Di halaman Referensi Progja, filter otomatis terkirim saat dropdown dipilih

### 3. Pagination

Halaman dengan banyak data menggunakan pagination:
- Klik nomor halaman untuk berpindah halaman
- Gunakan tombol **"Previous"** dan **"Next"** untuk navigasi

### 4. Badge Status

Sistem menggunakan badge warna untuk menandai status:
- **Biru** - Kategori, label umum
- **Hijau** - Status aktif, sukses
- **Merah** - Status tidak aktif, error
- **Kuning** - Peringatan
- **Orange** - Status khusus
- **Purple** - Kategori khusus
- **Secondary (Abu-abu)** - Status netral

---

## Troubleshooting

### 1. Tidak Bisa Login

**Masalah:** Email atau password salah

**Solusi:**
- Pastikan email dan password yang dimasukkan benar
- Pastikan tidak ada spasi di awal/akhir email
- Coba reset password melalui admin (Presidium)

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

### 4. Pertemuan Tidak Bisa Dihapus

**Masalah:** Tombol hapus tidak berfungsi atau error

**Solusi:**
- Pastikan user memiliki akses (Presidium atau Kabid bidang terkait)
- Pastikan tidak ada constraint database
- Coba refresh halaman dan coba lagi

### 5. Filter Tidak Berfungsi

**Masalah:** Filter di halaman tidak menghasilkan hasil yang diharapkan

**Solusi:**
- Pastikan filter sudah diisi dengan benar
- Di halaman Referensi Progja, filter otomatis terkirim saat dropdown dipilih (tidak perlu klik tombol)
- Coba clear filter dan isi ulang
- Coba refresh halaman

### 6. Upload File Gagal

**Masalah:** Upload foto atau file gagal

**Solusi:**
- Pastikan ukuran file tidak melebihi batas maksimal (biasanya 2-5 MB)
- Pastikan format file sesuai (JPG, PNG untuk gambar)
- Pastikan folder storage memiliki permission write
- Cek koneksi internet jika upload ke server

### 7. Export Excel Tidak Berfungsi

**Masalah:** Tombol export Excel tidak menghasilkan file

**Solusi:**
- Pastikan browser mengizinkan download
- Cek pop-up blocker browser
- Coba gunakan browser lain
- Pastikan server memiliki library PHP untuk Excel (PhpSpreadsheet)

### 8. Status Program Kerja Tidak Berubah Otomatis

**Masalah:** Status program kerja tidak berubah menjadi "Selesai" meskipun semua pertemuan sudah selesai

**Solusi:**
- Pastikan jumlah pertemuan sudah mencapai `frekuensi_kegiatan`
- Status otomatis berubah saat pertemuan ditambahkan/dihapus
- Jika masih tidak berubah, hubungi admin untuk update manual

### 9. Kabid Tidak Bisa Melihat Program Kerja

**Masalah:** Kabid tidak melihat program kerja di bidangnya

**Solusi:**
- Pastikan kabid sudah dikaitkan dengan kategori biro di periode yang benar
- Pastikan program kerja menggunakan kategori biro yang sama dengan kabid
- Pastikan program kerja menggunakan periode yang sama dengan kabid
- Cek filter status (kabid bisa melihat program kerja "Selesai" secara default)

### 10. Peserta Tidak Bisa Ditambahkan

**Masalah:** User tidak muncul di daftar "Tambah Peserta"

**Solusi:**
- Pastikan user memiliki periode yang sama dengan program kerja
- Pastikan user belum ditambahkan sebagai peserta sebelumnya
- Pastikan user memiliki role yang valid (Presidium, Kabid, atau Kader)

---

## Kontak dan Dukungan

Jika mengalami masalah yang tidak tercantum di atas atau membutuhkan bantuan lebih lanjut:

1. **Hubungi Admin/Presidium** untuk masalah akses dan permission
2. **Hubungi Developer** untuk masalah teknis
3. **Cek Log Error** di server untuk detail error

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
   - Status otomatis menjadi "Selesai" ketika jumlah pertemuan mencapai frekuensi kegiatan
   - Menghapus pertemuan akan mengubah status kembali ke "Aktif" jika belum mencapai frekuensi

5. **Filter Referensi Progja:**
   - Filter otomatis terkirim saat dropdown dipilih
   - Tidak perlu klik tombol "Filter"
   - Gunakan tombol "Reset Semua" untuk menghapus semua filter

---

**Versi Manual Book:** 1.0  
**Tanggal Update:** 2024  
**Sistem:** UKMI Ar-Rahman Management System

---

*Manual book ini akan terus diperbarui sesuai dengan perkembangan sistem.*

