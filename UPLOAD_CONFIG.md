# Konfigurasi Upload File Besar (200MB)

File ini menjelaskan konfigurasi yang diperlukan untuk mengupload file video hingga 200MB.

## Konfigurasi yang Sudah Diterapkan

### 1. Laravel Validation
- Maksimal ukuran file: **200MB** (204800 KB)
- Format yang didukung: MP4, AVI, MOV, WMV, FLV, WEBM

### 2. File Konfigurasi

#### `.htaccess` (Apache)
File `public/.htaccess` sudah dikonfigurasi dengan:
```apache
php_value upload_max_filesize 200M
php_value post_max_size 200M
php_value max_execution_time 300
php_value max_input_time 300
```

#### `.user.ini` (Shared Hosting)
File `public/.user.ini` sudah dibuat dengan konfigurasi yang sama.

## Konfigurasi Server Tambahan

### Apache
Jika menggunakan Apache, pastikan mod_php aktif dan konfigurasi di `.htaccess` berfungsi.

### Nginx
Jika menggunakan Nginx, tambahkan konfigurasi berikut di file konfigurasi server:

```nginx
client_max_body_size 200M;
client_body_timeout 300s;
```

### PHP-FPM
Jika menggunakan PHP-FPM, edit file `php.ini` atau file konfigurasi PHP-FPM:

```ini
upload_max_filesize = 200M
post_max_size = 200M
max_execution_time = 300
max_input_time = 300
memory_limit = 256M
```

### PHP CLI (untuk development)
Jika menggunakan `php artisan serve`, edit file `php.ini` atau buat file `.user.ini` di root project:

```ini
upload_max_filesize = 200M
post_max_size = 200M
max_execution_time = 300
max_input_time = 300
```

## Verifikasi Konfigurasi

Untuk memverifikasi bahwa konfigurasi sudah benar, buat file PHP sederhana:

```php
<?php
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "max_input_time: " . ini_get('max_input_time') . "\n";
```

## Troubleshooting

### Error: "PostTooLargeException"
1. Pastikan `post_max_size` lebih besar atau sama dengan `upload_max_filesize`
2. Restart web server setelah mengubah konfigurasi
3. Pastikan file `.htaccess` atau `.user.ini` ada di folder `public/`

### Error: "File terlalu besar"
1. Periksa konfigurasi PHP di server
2. Pastikan tidak ada batasan dari web server (Nginx/Apache)
3. Periksa log error untuk detail lebih lanjut

### Error: "Timeout"
1. Tingkatkan `max_execution_time` dan `max_input_time`
2. Pertimbangkan menggunakan upload chunk atau progress bar untuk file besar

## Catatan

- Ukuran maksimal 200MB sudah cukup besar, pertimbangkan kompresi video sebelum upload
- Untuk file yang lebih besar, pertimbangkan menggunakan URL video eksternal (YouTube, Vimeo, dll)
- Pastikan server memiliki ruang disk yang cukup untuk menyimpan file video

