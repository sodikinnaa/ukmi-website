# 🔐 Kredensial User untuk Demo - UKMI Ar-Rahman

## ⚠️ Catatan Penting
- **Semua password default**: `password`
- **URL Login**: `http://127.0.0.1:8009/login` (atau sesuai dengan URL server Anda)
- **Disarankan untuk mengubah password setelah login pertama kali**

---

## 👥 PRESIDIUM (4 User)

| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 1 | Usman Puji Rahayu | `usmanpuji@ukmi.test` | `password` | Ketua |
| 2 | Desti Fitriani | `desti@ukmi.test` | `password` | Wakil |
| 3 | Ichwan Solihin | `ichwan@ukmi.test` | `password` | Sekretaris |
| 4 | Dirta Putri Margiati | `dirta@ukmi.test` | `password` | Bendahara |

**Akses**: Dashboard Presidium, Manajemen User, Program Kerja, Kategori Biro, Periode Kepengurusan, Laporan, Role & Menu

---

## 👨‍💼 KABID - Kepala Bidang (18 User)

### Kaderisasi (3 User)
| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 1 | Aldo Fernanda | `aldo.kaderisasi@ukmi.test` | `password` | Ketua |
| 2 | Shafira | `shafira.kaderisasi@ukmi.test` | `password` | Sekretaris |
| 3 | Siti Nur Inayah | `siti.kaderisasi@ukmi.test` | `password` | Bendahara |

### KSI - Kajian dan Syiar Islam (3 User)
| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 4 | Soidkin | `soidkin.ksi@ukmi.test` | `password` | Ketua |
| 5 | Renita Verayani | `renita.ksi@ukmi.test` | `password` | Sekretaris |
| 6 | Fitria Aprianti | `fitria.ksi@ukmi.test` | `password` | Bendahara |

### BBQ - Bimbingan Baca Quran (3 User)
| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 7 | Bagus Sifaq Udin | `bagus.bbq@ukmi.test` | `password` | Ketua |
| 8 | Yulistiani | `yulistiani.bbq@ukmi.test` | `password` | Sekretaris |
| 9 | Novita Ulan Sari | `novita.bbq@ukmi.test` | `password` | Bendahara |

### Danus - Dana dan Usaha (3 User)
| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 10 | Aldo Febrian | `aldo.danus@ukmi.test` | `password` | Ketua |
| 11 | Tiara | `tiara.danus@ukmi.test` | `password` | Sekretaris |
| 12 | Fitri Sutiasih | `fitri.danus@ukmi.test` | `password` | Bendahara |

### Akademik (3 User)
| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 13 | Rangga Setiaji | `rangga.akademik@ukmi.test` | `password` | Ketua |
| 14 | Mufaza | `mufaza.akademik@ukmi.test` | `password` | Sekretaris |
| 15 | Nova Istiqomah | `nova.akademik@ukmi.test` | `password` | Bendahara |

### HMD - Humas dan Dokumentasi (3 User)
| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 16 | Rama Suherman | `rama.hmd@ukmi.test` | `password` | Ketua |
| 17 | Sekar Kinasih | `sekar.hmd@ukmi.test` | `password` | Sekretaris |
| 18 | Tiara Nada | `tiara.hmd@ukmi.test` | `password` | Bendahara |

**Akses**: Dashboard Kabid, Daftar Kader, Program Kerja (bidang terkait), Pertemuan, Absensi, Referensi Progja

---

## 👤 KADER

**Catatan**: User dengan role Kader tidak dibuat secara otomatis di seeder. Kader biasanya ditambahkan oleh Presidium melalui:
- Menu "Manajemen User" → Tambah User baru dengan role "Kader"
- Atau melalui Import Excel

**Akses**: Dashboard Kader, Program Saya, Absensi, Referensi Progja

---

## 🎓 PEMBINA (1 User)

| No | Nama | Email | Password | Jabatan |
|----|------|-------|----------|---------|
| 1 | Merli Sanjaya | `merli@ukmi.test` | `password` | Pembina |

**Akses**: Dashboard Pembina, Pengaturan Periode, Laporan, UNI (link eksternal)

---

## 📋 Ringkasan Cepat

### Presidium
- Email: `usmanpuji@ukmi.test` | Password: `password` (Ketua)
- Email: `desti@ukmi.test` | Password: `password` (Wakil)
- Email: `ichwan@ukmi.test` | Password: `password` (Sekretaris)
- Email: `dirta@ukmi.test` | Password: `password` (Bendahara)

### Kabid (Contoh)
- Email: `aldo.kaderisasi@ukmi.test` | Password: `password` (Ketua Kaderisasi)
- Email: `soidkin.ksi@ukmi.test` | Password: `password` (Ketua KSI)
- Email: `bagus.bbq@ukmi.test` | Password: `password` (Ketua BBQ)

### Pembina
- Email: `merli@ukmi.test` | Password: `password`

---

## 🔗 URL Dashboard Setelah Login

Setelah login, user akan diarahkan otomatis ke dashboard sesuai role:

- **Presidium**: `/presidium/dashboard`
- **Kabid**: `/kabid/dashboard`
- **Kader**: `/kader/dashboard`
- **Pembina**: `/pembina/dashboard`

---

## 📝 Cara Menggunakan

1. Buka browser dan akses: `http://127.0.0.1:8009/login`
2. Masukkan email dan password dari tabel di atas
3. Klik "Login"
4. Anda akan diarahkan ke dashboard sesuai role

---

## ⚠️ Peringatan Keamanan

- **JANGAN** gunakan kredensial ini di production!
- **WAJIB** ubah semua password setelah setup pertama kali
- **DISARANKAN** untuk membuat password yang kuat dan unik untuk setiap user
- File ini hanya untuk keperluan **DEMO dan DEVELOPMENT** saja

---

**Dibuat**: {{ date('d F Y') }}  
**Sistem**: UKMI Ar-Rahman Management System


