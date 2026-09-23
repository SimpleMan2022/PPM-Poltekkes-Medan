# Pusat Penjaminan Mutu Poltekkes Medan

Website profil dan sistem informasi Pusat Penjaminan Mutu (PPM) Politeknik Kesehatan Kemenkes Medan. Dibangun dengan Laravel 13 + Tailwind CSS.

## Fitur

**Halaman publik** (`/`)
- Hero carousel banner, sambutan pimpinan, layanan, dokumen & SOP (filter kategori, pencarian, unduhan PDF), galeri foto, link terkait (marquee), kontak + peta, profil struktur organisasi & tugas fungsi

**Panel admin** (`/admin`, perlu login)
- Dashboard ringkasan, Banner Slider, Sambutan & Profil (termasuk struktur organisasi & tupoksi), Layanan, Link Terkait, Dokumen & SOP (+ kategori), Galeri, Personalia
- Khusus Super Admin: Kelola Pengguna, Identitas Situs

Dua peran: `superadmin` (akses penuh) dan `admin_operator` (kelola konten, tanpa kelola pengguna/pengaturan).

## Syarat

- PHP ^8.3 
- Composer, Node.js + npm
- Database: MySQL

## Cara pakai

```bash
# 1. Install dependensi
composer install
npm install

# 2. Konfigurasi environment
cp .env.example .env
php artisan key:generate

php artisan migrate --seed

# 3. Symlink storage agar file upload bisa diakses
php artisan storage:link

# 4. Build aset frontend
npm run build

# 5. Jalankan
php artisan serve          # http://127.0.0.1:8000
```

Untuk development dengan hot-reload: `npm run dev` di terminal terpisah selagi `php artisan serve` jalan.

## Akun bawaan (dari seeder)

| Peran | Email | Password |
|---|---|---|
| Super Admin | superadmin@poltekkes.ac.id | password |
| Admin Operator | admin@poltekkes.ac.id | password |

```