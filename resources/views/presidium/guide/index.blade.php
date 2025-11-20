@extends('layouts.tabler')

@section('title', 'Manual Book / Panduan Sistem')

@section('pretitle', 'Guide')

@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">📘 Manual Book Sistem Manajemen UKMI Ar-Rahman</h3>
                <div class="card-subtitle text-muted">
                    Panduan lengkap penggunaan sistem untuk semua role
                </div>
            </div>
            <div class="card-body">
                <!-- Navigation untuk quick access -->
                <div class="mb-4">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <a href="#pendahuluan" class="btn btn-outline-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.828 4.828a2 2 0 0 0 -.586 1.414v4.172a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4.172a2 2 0 0 0 -.586 -1.414l-4.828 -4.828a2 2 0 0 1 -.586 -1.414v-2.172z" />
                                </svg>
                                Pendahuluan
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="#presidium" class="btn btn-outline-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                </svg>
                                Panduan Presidium
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="#kabid" class="btn btn-outline-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                                Panduan Kabid
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="#troubleshooting" class="btn btn-outline-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 8l0 4" />
                                    <path d="M12 16l.01 0" />
                                </svg>
                                Troubleshooting
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Content Manual Book -->
                <div class="manual-book-content" style="line-height: 1.8;">
                    
                    <!-- Pendahuluan -->
                    <section id="pendahuluan" class="mb-5">
                        <h2 class="mb-3">📖 Pendahuluan</h2>
                        <div class="card">
                            <div class="card-body">
                                <p class="lead">
                                    Sistem Manajemen UKMI Ar-Rahman adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola kegiatan organisasi Unit Kegiatan Mahasiswa Islam (UKMI) Ar-Rahman.
                                </p>
                                
                                <h4 class="mt-4 mb-3">Fitur Utama</h4>
                                <ul>
                                    <li>✅ Manajemen User dan Role</li>
                                    <li>✅ Manajemen Periode Kepengurusan</li>
                                    <li>✅ Manajemen Program Kerja</li>
                                    <li>✅ Manajemen Pertemuan</li>
                                    <li>✅ Sistem Absensi</li>
                                    <li>✅ Dokumentasi Kegiatan</li>
                                    <li>✅ Laporan dan Rekap</li>
                                    <li>✅ Referensi Program Kerja</li>
                                </ul>

                                <h4 class="mt-4 mb-3">Role dalam Sistem</h4>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">1. Presidium</h5>
                                                <p class="card-text">Administrator dengan akses penuh untuk mengelola seluruh sistem</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">2. Kabid</h5>
                                                <p class="card-text">Kepala Bidang/Biro dengan akses untuk mengelola program kerja di bidangnya</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">3. Kader</h5>
                                                <p class="card-text">Anggota aktif organisasi dengan akses untuk melihat program kerja yang diikutinya</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">4. Pembina</h5>
                                                <p class="card-text">Dewan Pembina dengan akses untuk melihat laporan dan monitoring kegiatan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Akses Sistem -->
                    <section id="akses-sistem" class="mb-5">
                        <h2 class="mb-3">🔐 Akses Sistem</h2>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Login ke Sistem</h4>
                                <ol>
                                    <li>Buka browser dan akses URL sistem</li>
                                    <li>Klik tombol <strong>"Login"</strong> atau akses langsung ke halaman login</li>
                                    <li>Masukkan <strong>Email</strong> dan <strong>Password</strong> Anda</li>
                                    <li>Klik tombol <strong>"Masuk"</strong></li>
                                </ol>

                                <div class="alert alert-info mt-3">
                                    <h5>Kredensial Default (Demo)</h5>
                                    <p class="mb-2"><strong>⚠️ PENTING:</strong> Kredensial berikut hanya untuk demo/testing. Pastikan untuk mengubah password di production!</p>
                                    <ul class="mb-0">
                                        <li><strong>Presidium:</strong> usmanpuji@ukmi.test / password</li>
                                        <li><strong>Kabid KSI:</strong> soidkin.ksi@ukmi.test / password</li>
                                        <li><strong>Pembina:</strong> merli@ukmi.test / password</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Panduan Presidium -->
                    <section id="presidium" class="mb-5">
                        <h2 class="mb-3">👑 Panduan Presidium</h2>
                        
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">1. Manajemen User</h4>
                            </div>
                            <div class="card-body">
                                <h5>Mengakses Halaman Manajemen User</h5>
                                <ol>
                                    <li>Klik menu <strong>"Manajemen User"</strong> di sidebar</li>
                                    <li>Sistem akan menampilkan halaman daftar user</li>
                                </ol>

                                <h5 class="mt-4">Menambah User Baru</h5>
                                <ol>
                                    <li>Klik tombol <strong>"Tambah User"</strong> di pojok kanan atas</li>
                                    <li>Isi form dengan data lengkap:
                                        <ul>
                                            <li>Nama Lengkap (wajib)</li>
                                            <li>Email (wajib, harus unik)</li>
                                            <li>Password (minimal 8 karakter)</li>
                                            <li>Role (Presidium, Kabid, Kader, Pembina)</li>
                                            <li>Data lainnya (opsional)</li>
                                        </ul>
                                    </li>
                                    <li>Klik <strong>"Simpan"</strong></li>
                                </ol>

                                <h5 class="mt-4">Import User dari Excel</h5>
                                <ol>
                                    <li>Klik tombol <strong>"Import User"</strong></li>
                                    <li>Download template Excel</li>
                                    <li>Isi template dengan data user</li>
                                    <li>Upload file Excel yang sudah diisi</li>
                                    <li>Preview data sebelum import</li>
                                    <li>Klik <strong>"Import"</strong> untuk menyelesaikan</li>
                                </ol>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">2. Manajemen Periode Kepengurusan</h4>
                            </div>
                            <div class="card-body">
                                <h5>Menambah Periode Baru</h5>
                                <ol>
                                    <li>Klik menu <strong>"Periode Kepengurusan"</strong> di sidebar</li>
                                    <li>Klik tombol <strong>"Tambah Periode"</strong></li>
                                    <li>Isi form:
                                        <ul>
                                            <li>Nama Periode (contoh: "Periode 2024-2025")</li>
                                            <li>Tanggal Mulai</li>
                                            <li>Tanggal Selesai (opsional)</li>
                                            <li>Status Aktif (centang jika ini periode aktif)</li>
                                        </ul>
                                    </li>
                                    <li>Klik <strong>"Simpan"</strong></li>
                                </ol>

                                <div class="alert alert-warning mt-3">
                                    <strong>⚠️ CATATAN:</strong> Hanya boleh ada satu periode aktif dalam satu waktu. Jika periode baru diaktifkan, periode aktif sebelumnya akan otomatis dinonaktifkan.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">3. Manajemen Kategori Biro</h4>
                            </div>
                            <div class="card-body">
                                <h5>Mengelola Kabid per Periode</h5>
                                <ol>
                                    <li>Klik menu <strong>"Kategori Biro"</strong> di sidebar</li>
                                    <li>Klik <strong>"Detail"</strong> pada kategori biro yang ingin dikelola</li>
                                    <li>Di tab <strong>"Kabid"</strong>, klik tombol <strong>"Tambah Kabid"</strong></li>
                                    <li>Pilih <strong>Periode</strong> dari dropdown</li>
                                    <li>Pilih <strong>Kabid</strong> dari dropdown</li>
                                    <li>Klik <strong>"Tambah"</strong></li>
                                </ol>

                                <div class="alert alert-info mt-3">
                                    <strong>ℹ️ INFO:</strong> Setiap kabid harus dikaitkan dengan periode kepengurusan tertentu. Kabid yang berbeda periode akan memiliki data yang berbeda.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">4. Manajemen Program Kerja</h4>
                            </div>
                            <div class="card-body">
                                <h5>Menambah Program Kerja Baru</h5>
                                <ol>
                                    <li>Klik menu <strong>"Program Kerja"</strong> di sidebar</li>
                                    <li>Klik tombol <strong>"Tambah Program Kerja"</strong></li>
                                    <li>Isi form dengan lengkap:
                                        <ul>
                                            <li>Judul Program Kerja (wajib)</li>
                                            <li>Deskripsi (wajib)</li>
                                            <li>Kategori Biro (wajib)</li>
                                            <li>Periode Kepengurusan (wajib)</li>
                                            <li>Foto Program Kerja (upload pamflet/poster)</li>
                                            <li>Frekuensi Kegiatan (jumlah pertemuan yang direncanakan)</li>
                                            <li>Kader yang Mengikuti (pilih dengan checkbox)</li>
                                        </ul>
                                    </li>
                                    <li>Klik <strong>"Simpan"</strong></li>
                                </ol>

                                <h5 class="mt-4">Mengelola Peserta Program Kerja</h5>
                                <ol>
                                    <li>Di halaman detail program kerja, scroll ke bagian <strong>"Peserta Program Kerja"</strong></li>
                                    <li>Klik tombol <strong>"Tambah Peserta"</strong></li>
                                    <li>Pilih user dengan checkbox (bisa pilih beberapa sekaligus)</li>
                                    <li>Klik <strong>"Tambah Peserta"</strong></li>
                                </ol>

                                <h5 class="mt-4">Mengelola Pertemuan</h5>
                                <ol>
                                    <li>Di halaman detail program kerja, scroll ke bagian <strong>"Pertemuan"</strong></li>
                                    <li>Klik tombol <strong>"Tambah Pertemuan"</strong></li>
                                    <li>Isi form:
                                        <ul>
                                            <li>Pertemuan Ke (otomatis diisi, bisa diubah jika ada gap)</li>
                                            <li>Tanggal Pertemuan</li>
                                            <li>Waktu Mulai dan Selesai</li>
                                            <li>Tempat</li>
                                            <li>Deskripsi (opsional)</li>
                                            <li>Foto Kegiatan (bisa upload beberapa)</li>
                                            <li>Foto Absen (bisa upload beberapa)</li>
                                        </ul>
                                    </li>
                                    <li>Klik <strong>"Simpan"</strong></li>
                                </ol>

                                <div class="alert alert-success mt-3">
                                    <strong>✅ TIP:</strong> Status program kerja otomatis berubah menjadi "Selesai" ketika jumlah pertemuan mencapai frekuensi kegiatan yang direncanakan.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">5. Referensi Program Kerja</h4>
                            </div>
                            <div class="card-body">
                                <h5>Menggunakan Filter (Auto-Filter)</h5>
                                <ol>
                                    <li>Klik menu <strong>"Referensi Progja"</strong> di sidebar</li>
                                    <li>Sistem menampilkan program kerja dari periode sebelumnya (non-aktif)</li>
                                    <li>Gunakan filter:
                                        <ul>
                                            <li><strong>Periode:</strong> Pilih dari dropdown - Filter otomatis terkirim</li>
                                            <li><strong>Status:</strong> Pilih dari dropdown - Filter otomatis terkirim</li>
                                            <li><strong>Kategori Biro:</strong> Pilih dari dropdown - Filter otomatis terkirim</li>
                                            <li><strong>Search:</strong> Ketik untuk mencari - Auto-filter setelah 500ms</li>
                                        </ul>
                                    </li>
                                    <li>Klik tombol <strong>"Reset Semua"</strong> untuk menghapus semua filter</li>
                                </ol>

                                <div class="alert alert-info mt-3">
                                    <strong>ℹ️ INFO:</strong> Di halaman Referensi Progja, filter otomatis terkirim saat dropdown dipilih. Tidak perlu klik tombol "Filter".
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Panduan Kabid -->
                    <section id="kabid" class="mb-5">
                        <h2 class="mb-3">👔 Panduan Kabid</h2>
                        <div class="card">
                            <div class="card-body">
                                <p>Kabid (Kepala Bidang/Biro) memiliki akses terbatas untuk mengelola program kerja di bidangnya.</p>

                                <h5 class="mt-4">Program Kerja</h5>
                                <ul>
                                    <li>Kabid dapat melihat program kerja di bidangnya (termasuk yang sudah selesai)</li>
                                    <li>Kabid dapat menambah dan menghapus peserta program kerja</li>
                                    <li>Kabid memiliki akses penuh untuk mengelola pertemuan (tambah, edit, hapus)</li>
                                </ul>

                                <h5 class="mt-4">Ketentuan</h5>
                                <ul>
                                    <li>Kabid hanya bisa menambah user dalam periode yang sama dengan kabid</li>
                                    <li>Kabid hanya bisa mengelola program kerja di kategori biro yang ditugaskan</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Panduan Kader -->
                    <section id="kader" class="mb-5">
                        <h2 class="mb-3">👤 Panduan Kader</h2>
                        <div class="card">
                            <div class="card-body">
                                <p>Kader memiliki akses terbatas untuk melihat program kerja yang diikutinya.</p>

                                <h5 class="mt-4">Program</h5>
                                <ul>
                                    <li>Kader dapat melihat program kerja yang diikutinya</li>
                                    <li>Kader dapat melihat detail program kerja, peserta, dan pertemuan</li>
                                    <li>Kader dapat melihat absensi pribadi</li>
                                </ul>

                                <h5 class="mt-4">Absensi</h5>
                                <ul>
                                    <li>Kader dapat melihat riwayat absensi pribadi</li>
                                    <li>Kader dapat melihat status kehadiran di setiap pertemuan</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Panduan Pembina -->
                    <section id="pembina" class="mb-5">
                        <h2 class="mb-3">🎓 Panduan Pembina</h2>
                        <div class="card">
                            <div class="card-body">
                                <p>Pembina memiliki akses untuk melihat laporan dan monitoring kegiatan organisasi.</p>

                                <h5 class="mt-4">Periode Kepengurusan</h5>
                                <ul>
                                    <li>Pembina dapat melihat daftar periode kepengurusan</li>
                                    <li>Pembina dapat melihat detail periode dan struktur organisasi</li>
                                </ul>

                                <h5 class="mt-4">Laporan</h5>
                                <ul>
                                    <li>Pembina dapat melihat laporan kegiatan organisasi</li>
                                    <li>Pembina dapat export laporan ke Excel</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Troubleshooting -->
                    <section id="troubleshooting" class="mb-5">
                        <h2 class="mb-3">🔧 Troubleshooting</h2>
                        
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">1. Tidak Bisa Login</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Masalah:</strong> Email atau password salah</p>
                                <p><strong>Solusi:</strong></p>
                                <ul>
                                    <li>Pastikan email dan password yang dimasukkan benar</li>
                                    <li>Pastikan tidak ada spasi di awal/akhir email</li>
                                    <li>Coba reset password melalui admin (Presidium)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">2. Menu Tidak Muncul</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Masalah:</strong> Menu tertentu tidak muncul di sidebar</p>
                                <p><strong>Solusi:</strong></p>
                                <ul>
                                    <li>Pastikan user memiliki role yang sesuai</li>
                                    <li>Pastikan menu aktif di Manajemen Menu (untuk Presidium)</li>
                                    <li>Pastikan user memiliki permission untuk menu tersebut</li>
                                    <li>Coba refresh halaman (F5)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">3. Filter Tidak Berfungsi</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Masalah:</strong> Filter di halaman tidak menghasilkan hasil yang diharapkan</p>
                                <p><strong>Solusi:</strong></p>
                                <ul>
                                    <li>Pastikan filter sudah diisi dengan benar</li>
                                    <li>Di halaman Referensi Progja, filter otomatis terkirim saat dropdown dipilih (tidak perlu klik tombol)</li>
                                    <li>Coba clear filter dan isi ulang</li>
                                    <li>Coba refresh halaman</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">4. Upload File Gagal</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Masalah:</strong> Upload foto atau file gagal</p>
                                <p><strong>Solusi:</strong></p>
                                <ul>
                                    <li>Pastikan ukuran file tidak melebihi batas maksimal (biasanya 2-5 MB)</li>
                                    <li>Pastikan format file sesuai (JPG, PNG untuk gambar)</li>
                                    <li>Pastikan folder storage memiliki permission write</li>
                                    <li>Cek koneksi internet jika upload ke server</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">5. Status Program Kerja Tidak Berubah Otomatis</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Masalah:</strong> Status program kerja tidak berubah menjadi "Selesai" meskipun semua pertemuan sudah selesai</p>
                                <p><strong>Solusi:</strong></p>
                                <ul>
                                    <li>Pastikan jumlah pertemuan sudah mencapai <code>frekuensi_kegiatan</code></li>
                                    <li>Status otomatis berubah saat pertemuan ditambahkan/dihapus</li>
                                    <li>Jika masih tidak berubah, hubungi admin untuk update manual</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Catatan Penting -->
                    <section id="catatan-penting" class="mb-5">
                        <h2 class="mb-3">⚠️ Catatan Penting</h2>
                        <div class="card">
                            <div class="card-body">
                                <h5>Keamanan</h5>
                                <ul>
                                    <li>Jangan bagikan kredensial login</li>
                                    <li>Ganti password default di production</li>
                                    <li>Logout setelah selesai menggunakan sistem</li>
                                </ul>

                                <h5 class="mt-4">Backup</h5>
                                <ul>
                                    <li>Lakukan backup database secara berkala</li>
                                    <li>Backup file upload (foto, dokumentasi) secara berkala</li>
                                </ul>

                                <h5 class="mt-4">Periode Kepengurusan</h5>
                                <ul>
                                    <li>Hanya boleh ada satu periode aktif</li>
                                    <li>Pastikan periode baru sudah dibuat sebelum periode lama berakhir</li>
                                </ul>

                                <h5 class="mt-4">Program Kerja</h5>
                                <ul>
                                    <li>Status otomatis menjadi "Selesai" ketika jumlah pertemuan mencapai frekuensi kegiatan</li>
                                    <li>Menghapus pertemuan akan mengubah status kembali ke "Aktif" jika belum mencapai frekuensi</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
            <div class="card-footer">
                <div class="text-center text-muted">
                    <p class="mb-0">Manual Book ini akan terus diperbarui sesuai dengan perkembangan sistem.</p>
                    <p class="mb-0">Versi: 1.0 | Tanggal Update: {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .manual-book-content {
        font-size: 1rem;
    }
    
    .manual-book-content h2 {
        color: var(--tblr-primary);
        border-bottom: 2px solid var(--tblr-primary);
        padding-bottom: 0.5rem;
        margin-top: 2rem;
    }
    
    .manual-book-content h3 {
        color: var(--tblr-body-color);
        margin-top: 1.5rem;
    }
    
    .manual-book-content h4 {
        color: var(--tblr-body-color);
        margin-top: 1rem;
    }
    
    .manual-book-content h5 {
        color: var(--tblr-body-color);
        font-weight: 600;
    }
    
    .manual-book-content ol,
    .manual-book-content ul {
        padding-left: 1.5rem;
    }
    
    .manual-book-content ol li,
    .manual-book-content ul li {
        margin-bottom: 0.5rem;
    }
    
    .manual-book-content code {
        background-color: var(--tblr-bg-surface-secondary);
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.9em;
    }
    
    .manual-book-content section {
        scroll-margin-top: 2rem;
    }
    
    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

@push('scripts')
<script>
    // Smooth scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush

@endsection

