# SISFO Akademik Siswa

Sistem Informasi Akademik berbasis Laravel + template SB Admin 2.

Fitur: login admin, CRUD Kelas / Siswa / Guru / Mata Pelajaran, input nilai (nilai akhir dan status
Lulus/Tidak Lulus dihitung otomatis), detail siswa beserta rekap nilainya, dan dashboard ringkasan.

Nilai akhir = (Tugas x 0,3) + (UTS x 0,3) + (UAS x 0,4). Lulus bila nilai akhir >= KKM mata pelajaran.

## Menjalankan

Butuh PHP 8.4+ dan Composer (sesuai `composer.lock`).

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # Windows: type nul > database\database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

Buka http://127.0.0.1:8000 lalu login:

- Email: `admin@admin.com`
- Password: `password` (segera ganti kalau dipakai di luar latihan)

## Tes

```bash
php artisan test
```
