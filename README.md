# Laravel12-Starter

Laravel12-Starter adalah starter project berbasis Laravel 12 yang telah dilengkapi dengan fitur autentikasi, role-permission based app, serta manajemen menu dan user. Cocok digunakan sebagai dasar untuk mengembangkan aplikasi berbasis Laravel.

## ✨ Fitur

- 🔐 **Autentikasi** (Login, Register, Logout)
- 🛡️ **Role & Permission** (Menggunakan Spatie Laravel Permission)
- 📋 **Manajemen Menu & User**
- 🎨 **Template UI with Mazer** (Opsional, bisa dikembangkan lebih lanjut)

## ⚙️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

```bash
# 1. Clone repository ini
git clone https://github.com/plafound/laravel12-starter.git

# 2. Masuk ke direktori proyek
cd laravel12-starter

# 3. Install dependency composer
composer install

# 4. Install dependency NPM (jika menggunakan frontend assets)
npm install && npm run dev

# 5. Copy file konfigurasi
cp .env.example .env

# 6. Generate application key
php artisan key:generate

# 7. Konfigurasi database di file .env
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database

# 8. Jalankan migrasi dan seeder
php artisan migrate --seed

# 9. Jalankan aplikasi
php artisan serve
```

## 🔑 Akun Default

Setelah menjalankan seeder, gunakan akun berikut untuk login:

```
Email: admin@mail.com
Password: password
```

## 🛡️ Aktifkan semua role-permission untuk admin

Setelah login menggunakan akun admin. Maka akan otomatis masuk halaman dashboard. Untuk membuka semua menu. Caranya ?

```
# Masuk ke URL
https://<your_domain>/roles
```
dan aktifkan semua permission untuk admin. maka Menu lainnya juga akan otomatis terbuka ketika permission diaktifkan.
Begitu juga dengan user lainnya. 

So, manage your Role dan Permission wisely.

## ✨ ENJOY IT.

---------------------------------------------------

## 📄 Lisensi

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---